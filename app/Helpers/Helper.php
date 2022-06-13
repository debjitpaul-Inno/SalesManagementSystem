<?php

namespace App\Helpers;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

//use Yajra\DataTables\DataTables;

class Helper
{

    static function date_format($date = null, $type = 'HUMAN', $format = 'Y-m-d')
    {
        switch ($type) {
            case 'HUMAN':
                return date("F jS, Y", strtotime($date ? $date : date('m/d/Y h:i:s a', time())));
            case "CURRENT_YEAR":
                return date("Y");
            default:

        }

    }

    static public function checkedTitle($array, $value)
    {
        if (!$array) return '';
        foreach ($array as $item) {
            echo $item['title'] === $value ? 'checked' : '';

        }

    }

    static public function profile()
    {
        $profile = Profile::where('user_id', auth()->user()->id ?? '')->first();
        if ($profile != null) {
            return [
                'name' => $profile->full_name,
                'image' => $profile->image,
            ];
        }
    }

    static public function showProfile()
    {
        $user = User::where('id', auth()->user()->id ?? '')->first();
        $data = Profile::where('user_id', $user->id ?? '')->first();
        return [
            'uuid' => $data->uuid ?? ''
        ];
    }

    static public function userRolePermission()
    {
        $user = \auth()->user()->id ?? '';
        $data = DB::select("SELECT pr.role_id, pr.permission_id,ru.user_id, ru.role_id AS role_id FROM permission_assign_to_roles AS pr
                                    INNER JOIN role_assign_to_user AS ru
                                    ON pr.role_id = ru.role_id
                                    WHERE ru.user_id = '{$user}'");

        return [
            'userPermission' => $data ?? ''
        ];
    }

    static public function logo(){
        $settings = Setting::where('id',1)->first();
        if ($settings != null){
            return[
                'logo' => $settings->logo,
            ];
        }
    }
    static public function favicon(){
        $settings = Setting::where('id',1)->first();
        if ($settings != null){
            return[
                'favicon' => $settings->favicon,
            ];
        }
    }
        static public function permission()
    {
        $permission = Permission::all();
        return [
            'permission' => $permission ?? ''
        ];
    }
    static public function menuList()
    {
        return [
            [
                'sideIcon' => 'bi bi-cpu',
                'title' => 'DASHBOARD',
                'link' => \route('dashboard'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'dashboard.index',

            ],
            [
                'sideIcon' => "bi bi-collection",
                'title' => 'CATEGORY',
                'link' => \route('category.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'category.index',

            ],
            [
                'sideIcon' => 'bi bi-subtract',
                'title' => 'SUB-CATEGORY',
                'link' => \route('sub-category.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'sub-category.index',

            ],
            [
                'sideIcon' => 'bi bi-globe2',
                'title' => 'SUPPLIER',
                'link' => \route('vendor.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'vendor.index',

            ],
            [
                'sideIcon' => 'fas fa-store-alt',
                'title' => 'WAREHOUSE',
                'link' => \route('store.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'store.index',

            ],
            [
                'sideIcon' => 'fas fa-th-large',
                'title' => 'SHELF',
                'link' => \route('shelf.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'shelf.index',

            ],
            [
                'sideIcon' => 'fas fa-th-list',
                'title' => 'RACK',
                'link' => \route('rack.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'rack.index',
            ],
            [
                'sideIcon' => 'bi bi-boxes',
                'title' => 'PRODUCT',
                'link' => \route('product.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'product.index',

            ],
            [
                'sideIcon' => 'bi bi-hourglass-split',
                'title' => 'OFFERS',
                'link' => \route('offer.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'offer.index',

            ],
            [
                'sideIcon' => "bi bi-cart-dash-fill",
                'title' => 'ORDER',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'order.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'WITHOUT SCANNER',
                        'link' => \route('order.index'),
                        'permission' => 'order.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'WITH SCANNER',
                        'link' => \route('order.pos.index'),
                        'permission' => 'order.pos.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'SELL RETURN',
                        'link' => \route('order.pos.sellReturn'),
                        'permission' => 'order.pos.sellReturn'
                    ],

                ],

            ],

//            [
//                'sideIcon' => "fas fa-shopping-cart",
//                'title' => 'STOCK IN',
//                'link' => \route('stock-in.index'),
//                'hasSub' => false,
//                'subMenu' => [],
//                'permission' => 'dashboard.index',
//
//            ],

            [
                'sideIcon' => 'bi bi-bag-plus-fill',
                'title' => 'STOCK IN',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'stock-in.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'WITHOUT SCANNER',
                        'link' => \route('stock-in.index'),
                        'permission' => 'stock-in.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'WITH SCANNER',
                        'link' => \route('stockIn.pos.index'),
                        'permission' => 'stockIn.pos.index'
                    ],
                ],
            ],
            [
                'sideIcon' => 'bi bi-exclamation-triangle-fill',
                'title' => 'DAMAGE',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'damage.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'WITHOUT SCANNER',
                        'link' => \route('damage.index'),
                        'permission' => 'damage.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'WITH SCANNER',
                        'link' => \route('damage.pos.index'),
                        'permission' => 'damage.pos.index'
                    ],
                ],
            ],


            [
                'sideIcon' => 'fas fa-male',
                'title' => 'CUSTOMER',
                'link' => \route('customer.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'customer.index',

            ],
            [
                'sideIcon' => 'bi bi-award',
                'title' => 'CUSTOMER LOYALTY',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'member.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'MEMBERS',
                        'link' => \route('member.index'),
                        'permission' => 'member.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'MEMBERSHIP TYPE',
                        'link' => \route('membership-type.index'),
                        'permission' => 'membership-type.index'
                    ],
                ],
            ],

            [
                'sideIcon' => 'bi bi-coin',
                'title' => 'ACCOUNTS',
                'link' => \route('account.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'account.index',
            ],
            [
                'sideIcon' => 'bi bi-currency-exchange',
                'title' => 'REPORTS',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'report.credit',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'EXPENSE REPORT',
                        'link' => \route('report.credit'),
                        'permission' => 'report.credit'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'EXPENSE DUE REPORT',
                        'link' => \route('report.credit.due'),
                        'permission' => 'report.credit.due'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'EARNING REPORT',
                        'link' => \route('report.debit'),
                        'permission' => 'report.debit'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'EARNING DUE REPORT',
                        'link' => \route('report.debit.due'),
                        'permission' => 'report.debit.due'
                    ],
                ],
            ],
            [
                'sideIcon' => 'bi bi-chat-square-text',
                'title' => 'SMS',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'sms.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'SMS TEMPLATES',
                        'link' => \route('sms-template.index'),
                        'permission' => 'sms-template.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'SMS',
                        'link' => \route('sms.index'),
                        'permission' => 'sms.index'
                    ]
                ],
            ],
            [
                'sideIcon' => 'bi bi-person-workspace',
                'title' => 'SYSTEM USERS',
                'link' => '#',
                'hasSub' => true,
                'permission' => 'user.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'USERS',
                        'link' => \route('user.index'),
                        'permission' => 'user.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'ROLE',
                        'link' => \route('role.index'),
                        'permission' => 'role.index'
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'PERMISSION',
                        'link' => \route('permission.index'),
                        'permission' => 'permission.index'
                    ],
                ],
            ],
            [
                'sideIcon' => 'bi bi-gear',
                'title' => 'SETTINGS',
                'link' => \route('setting.create'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'setting.create',
            ],
        ];
    }

}
