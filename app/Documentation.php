<?php

namespace App;

use File;

class Documentation
{
    public function get($file = 'documentation.md') {
        $content = File::get($this->path($file));
        return $this->replaceLinks($content);
    }
    
    public function image($file) {
        return \Image::make($this->path($file, 'docs/images'));
    }
    protected function path($file, $dir = 'docs') {
        $file = ends_with($file, ['.md', '.jpg']) ? $file : $file . '.md';
        $path = base_path($dir . DIRECTORY_SEPARATOR . $file);
        
        if( ! File::exists($path)) {
            //dd($path);
            abort(404, '요청한 파일이 없는거 같은뎅.');
        }
        return $path;
    }
    
    protected function replaceLinks($content) {
        return str_replace('/docs/{{version}}', '/docs', $content);
    }
    //
}
