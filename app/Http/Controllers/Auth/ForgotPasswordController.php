<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    private $categories;
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    use SendsPasswordResetEmails;
}
