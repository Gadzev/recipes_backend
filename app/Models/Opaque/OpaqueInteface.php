<?php

namespace App\Models\Opaque;

interface OpaqueInterface
{
    function toArray() : array;
    function toJson() : String;
}