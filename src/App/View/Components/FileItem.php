<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use Illuminate\View\Component;

class FileItem extends Component
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function render()
    {
        return view('console-service::components.file-item');
    }
}
