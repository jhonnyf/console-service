<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use Illuminate\View\Component;

class FilesList extends Component
{
    public $files;

    public function __construct($files)
    {
        $this->files = $files;
    }

    public function render()
    {
        return view('console-service::components.files-list');
    }
}
