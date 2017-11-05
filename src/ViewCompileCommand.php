<?php

declare(strict_types = 1);

namespace Melihovv\LaravelCompileViews;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewFinderInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Throwable;

class ViewCompileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:compile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compile all app views';

    /**
     * Blade extensions.
     *
     * @var array
     */
    protected $extensions;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var FileViewFinder $finder */
        $finder = app()['view']->getFinder();

        $this->extensions = $finder->getExtensions();

        collect($finder->getPaths())
            ->each(function (string $path) {
                $this->compileViews(collect(Finder::create()->in($path)->exclude('vendor')->files()));
            });

        collect($finder->getHints())
            ->each(function ($paths, $namespace) {
                $this->compileViews(collect(Finder::create()->in(array_reverse($paths))->files()), $namespace);
            });

        $this->info('Views were successfully compiled!');

        return 0;
    }

    /**
     * @param Collection $viewFiles
     * @param string|null $namespace
     */
    protected function compileViews(Collection $viewFiles, $namespace = null)
    {
        $viewFiles
            ->map(function (SplFileInfo $file) use ($namespace) {
                return $this->getViewName($file, $namespace);
            })
            ->each(function (string $viewName) {
                $this->compileView($viewName);
            });
    }

    /**
     * @param string $viewName
     */
    protected function compileView(string $viewName)
    {
        try {
            View::make($viewName)->render();
        } catch (Throwable $e) {
        }
    }

    /**
     * @param SplFileInfo $viewFile
     * @param string|null $namespace
     * @return string
     */
    protected function getViewName($viewFile, $namespace = null)
    {
        $viewName = str_replace(
            array_merge([DIRECTORY_SEPARATOR], array_map(function (string $ext) {return ".$ext";}, $this->extensions)),
            array_merge(['.'], array_map(function () {return '';}, $this->extensions)),
            $viewFile->getRelativePathname()
        );

        if ($namespace) {
            return $namespace . ViewFinderInterface::HINT_PATH_DELIMITER . $viewName;
        }

        return $viewName;
    }
}
