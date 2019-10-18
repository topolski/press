<?php

namespace topolski\Press\Drivers;

use Illuminate\Support\Facades\File;
use topolski\Press\Exceptions\FileDriverDirectoryNotFoundException;

class FileDriver extends Driver
{
    /**
     * Fetch and parse all of the posts for the given source.
     *
     * @return mixed
     */
    public function fetchPosts()
    {
        $files = File::files($this->config['path']);

        foreach ($files as $file) {
            $this->parse($file->getPathname(), $file->getFilename());
        }

        return $this->posts;
    }

    /**
     * Instantiates the PressFileParser and build up an array of posts.
     *
     * @return bool|void
     * @throws \topolski\Press\Exceptions\FileDriverDirectoryNotFoundException
     *
     * @return void
     */
    protected function validateSource()
    {
        if ( ! File::exists($this->config['path'])) {
            throw new FileDriverDirectoryNotFoundException(
                'Directory at \''. $this->config['path'] . '\' does not exist. ' .
                'Check the directory path in the config file.'
            );
        }
    }
}