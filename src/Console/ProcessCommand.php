<?php

namespace topolski\Press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use topolski\Press\Post;
use topolski\Press\Facades\Press;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        try {
            $posts = Press::driver()->fetchPosts();

            foreach ($posts as $post) {
                Post::create([
                    'identifier' => $post['identifier'],
                    'slug' => Str::slug($post['title']),
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'extra' => $post['extra'] ?? '',
                ]);
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}