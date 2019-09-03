<?php

namespace App\ImageUtils;

use Imagine\Image\ImagineInterface;
use Liip\ImagineBundle\Binary\Loader\LoaderInterface;

class RemoteLoader implements LoaderInterface
{
    protected $imagine;
    protected $wrapperPrefix;
    public function __construct(ImagineInterface $imagine, $wrapperPrefix)
    {
        $this->imagine = $imagine;
        $this->wrapperPrefix = $wrapperPrefix;
    }
    public function find($path)
    {
        $path = preg_replace('@\:/(\w)@', '://$1', $path);
        return $this->imagine->load(file_get_contents($path));
    }
}
