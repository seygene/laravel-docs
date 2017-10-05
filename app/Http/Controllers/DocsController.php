<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    protected $docs;
    
    public function __construct(\App\Documentation $docs) {
        $this->docs = $docs;
        //dd($docs->get());
    }
    
    public function show($file = null) {
        $index = markdown($this->docs->get());
        $content2 = markdown($this->docs->get($file ? $file : 'installation.md'));
        return view('docs.show', compact('index', 'content2'));
    }
    
    public function show2($file = null) {
        $text = (new \App\Documentation)->get($file);
        return app(\Parsedown::class)->text($text);        
    }

}
