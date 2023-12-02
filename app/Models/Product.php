<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'wecartId',
        'productId',
        'brandId',
        'featuredImage',
        'name',
        'code',
        'breadcrumb',
        'currency',
        'description',
        'slug',
        'metaTitle',
        'metaDescription',
        'discountRate',
        'sessionalDiscountRate',
        'sessionalDiscountStart',
        'sessionalDiscountEnd',
        'status',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     *
    CREATE TABLE `akilliphone_newcart`.`product` (`id` INT NOT NULL AUTO_INCREMENT , `wecartId` INT NOT NULL , `productId` INT NOT NULL , `brandId` INT NOT NULL , `featuredImage` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `code` VARCHAR(255) NOT NULL , `breadcrumb` VARCHAR(255) NOT NULL , `currency` VARCHAR(255) NOT NULL , `description` VARCHAR(255) NOT NULL , `slug` INT NOT NULL , `metaTitle` VARCHAR(255) NOT NULL , `metaDescription` VARCHAR(255) NOT NULL , `discountRate` INT NOT NULL , `sessionalDiscountRate` INT NOT NULL , `sessionalDiscountStart` INT NOT NULL , `sessionalDiscountEnd` INT NOT NULL , `status` INT NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`), UNIQUE (`productId`)) ENGINE = InnoDB;     */
}
