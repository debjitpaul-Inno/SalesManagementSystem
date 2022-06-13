<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $permissions = [
            [
                "title" => 'Dashboard',
                "slug" => 'dashboard.index',
            ],
            //profile

            [
                "title" => 'Create Profile',
                "slug" => 'profile.store',
            ],
            [
                "title" => 'Profile Edit View',
                "slug" => 'profile.edit',
            ],
            [
                "title" => 'Profile Update',
                "slug" => 'profile.update',
            ],
            [
                "title" => 'Profile Info',
                "slug" => 'profile.show',
            ],


            //account
            [
                "title" => 'Account List',
                "slug" => 'account.index',
            ],
            [
                "title" => 'Account Create View',
                "slug" => 'account.create',
            ],
            [
                "title" => 'Create Account',
                "slug" => 'account.store',
            ],
            [
                "title" => 'Account Edit View ',
                "slug" => 'account.edit',
            ],
            [
                "title" => 'Update Account',
                "slug" => 'account.update',
            ],
            [
                "title" => 'Delete Account',
                "slug" => 'account.destroy',
            ],
            [
                "title" => 'Account Info',
                "slug" => 'account.show',
            ],

            //debitReport
            [
                "title" => 'Debit Report List',
                "slug" => 'report.debit',
            ],
            //creditReport
            [
                "title" => 'Credit Report List',
                "slug" => 'report.credit',
            ],

            //debitDueReport
            [
                "title" => 'Debit Due Report List',
                "slug" => 'report.debit.due',
            ],

            //creditReport
            [
                "title" => 'Credit Due Report List',
                "slug" => 'report.credit.due',
            ],

            //user
            [
                "title" => 'User List',
                "slug" => 'user.index',
            ],
            [
                "title" => 'User Create View',
                "slug" => 'user.create',
            ],
            [
                "title" => 'Create User',
                "slug" => 'user.store',
            ],
            [
                "title" => 'User Edit View',
                "slug" => 'user.edit',
            ],
            [
                "title" => 'Update User',
                "slug" => 'user.update',
            ],
            [
                "title" => 'Delete User',
                "slug" => 'user.destroy',
            ],
            [
                "title" => 'User Info',
                "slug" => 'user.show',
            ],
            //role
            [
                "title" => 'Role List',
                "slug" => 'role.index',
            ],
            [
                "title" => 'Role Create View',
                "slug" => 'role.create',
            ],
            [
                "title" => 'Create Role',
                "slug" => 'role.store',
            ],
            [
                "title" => 'Role Edit View',
                "slug" => 'role.edit',
            ],
            [
                "title" => 'Update Role',
                "slug" => 'role.update',
            ],
            [
                "title" => 'Delete Role',
                "slug" => 'role.destroy',
            ],
            [
                "title" => 'Role Info',
                "slug" => 'role.show',
            ],
            //permission
            [
                "title" => 'Permission List',
                "slug" => 'permission.index',
            ],
            [
                "title" => 'Permission Create View',
                "slug" => 'permission.create',
            ],
            [
                "title" => 'Create Permission',
                "slug" => 'permission.store',
            ],
            [
                "title" => 'Permission Edit View',
                "slug" => 'permission.edit',
            ],
            [
                "title" => 'Update Permission',
                "slug" => 'permission.update',
            ],
            [
                "title" => 'Delete Permission',
                "slug" => 'permission.destroy',
            ],
            [
                "title" => 'Permission Info',
                "slug" => 'permission.show',
            ],

            //setting
            [
                "title" => 'Setting Create View',
                "slug" => 'setting.create',
            ],
            [
                "title" => 'Create Setting',
                "slug" => 'setting.store',
            ],
            [
                "title" => 'Setting Edit View',
                "slug" => 'setting.edit',
            ],
            [
                "title" => 'Update Setting',
                "slug" => 'setting.update',
            ],//
        //Category
            [
                "title" => 'Category List',
                "slug" => 'category.index',
            ],
            [
                "title" => 'Category Create View',
                "slug" => 'category.create',
            ],
            [
                "title" => 'Create Category',
                "slug" => 'category.store',
            ],
            [
                "title" => 'Category Edit View',
                "slug" => 'category.edit',
            ],
            [
                "title" => 'Update Category',
                "slug" => 'category.update',
            ],
            [
                "title" => 'Delete Category',
                "slug" => 'category.destroy',
            ],
            [
                "title" => 'Category Info',
                "slug" => 'category.show',
            ],
        //Sub Category
            [
                "title" => 'Sub Category List',
                "slug" => 'sub-category.index',
            ],
            [
                "title" => 'Sub Category Create View',
                "slug" => 'sub-category.create',
            ],
            [
                "title" => 'Create Sub Category',
                "slug" => 'sub-category.store',
            ],
            [
                "title" => 'Sub Category Edit View',
                "slug" => 'sub-category.edit',
            ],
            [
                "title" => 'Update Sub Category',
                "slug" => 'sub-category.update',
            ],
            [
                "title" => 'Delete Sub Category',
                "slug" => 'sub-category.destroy',
            ],
            [
                "title" => 'Sub Category Info',
                "slug" => 'sub-category.show',
            ],

            //vendor
            [
                "title" => 'Vendor List',
                "slug" => 'vendor.index',
            ],
            [
                "title" => 'Vendor Create View',
                "slug" => 'vendor.create',
            ],
            [
                "title" => 'Create Vendor',
                "slug" => 'vendor.store',
            ],
            [
                "title" => 'Vendor Edit View',
                "slug" => 'vendor.edit',
            ],
            [
                "title" => 'Update Vendor',
                "slug" => 'vendor.update',
            ],
            [
                "title" => 'Delete Vendor',
                "slug" => 'vendor.destroy',
            ],
            [
                "title" => 'Vendor Info',
                "slug" => 'vendor.show',
            ],

            //store
            [
                "title" => 'Store List',
                "slug" => 'store.index',
            ],
            [
                "title" => 'Store Create View',
                "slug" => 'store.create',
            ],
            [
                "title" => 'Create Store',
                "slug" => 'store.store',
            ],
            [
                "title" => 'Store Edit View',
                "slug" => 'store.edit',
            ],
            [
                "title" => 'Update Store',
                "slug" => 'store.update',
            ],
            [
                "title" => 'Delete Store',
                "slug" => 'store.destroy',
            ],
            [
                "title" => 'Store Info',
                "slug" => 'store.show',
            ],


            //shelf
            [
                "title" => 'Shelf List',
                "slug" => 'shelf.index',
            ],
            [
                "title" => 'Shelf Create View',
                "slug" => 'shelf.create',
            ],
            [
                "title" => 'Create Shelf',
                "slug" => 'shelf.store',
            ],
            [
                "title" => 'Shelf Edit View',
                "slug" => 'shelf.edit',
            ],
            [
                "title" => 'Update Shelf',
                "slug" => 'shelf.update',
            ],
            [
                "title" => 'Delete Shelf',
                "slug" => 'shelf.destroy',
            ],
            [
                "title" => 'Shelf Info',
                "slug" => 'shelf.show',
            ],
            //rack
            [
                "title" => 'Rack List',
                "slug" => 'rack.index',
            ],
            [
                "title" => 'Rack Create View',
                "slug" => 'rack.create',
            ],
            [
                "title" => 'Create Rack',
                "slug" => 'rack.store',
            ],
            [
                "title" => 'Rack Edit View',
                "slug" => 'rack.edit',
            ],
            [
                "title" => 'Update Rack',
                "slug" => 'rack.update',
            ],
            [
                "title" => 'Delete Rack',
                "slug" => 'rack.destroy',
            ],
            [
                "title" => 'Rack Info',
                "slug" => 'rack.show',
            ],


        //Product
            [
                "title" => 'Product List',
                "slug" => 'product.index',
            ],
            [
                "title" => 'Product Create View',
                "slug" => 'product.create',
            ],
            [
                "title" => 'Create Product',
                "slug" => 'product.store',
            ],
            [
                "title" => 'Product Edit View',
                "slug" => 'product.edit',
            ],
            [
                "title" => 'Update Product',
                "slug" => 'product.update',
            ],
            [
                "title" => 'Delete Product',
                "slug" => 'product.destroy',
            ],
            [
                "title" => 'Product Info',
                "slug" => 'product.show',
            ],
            [
                "title" => 'Product Barcode ',
                "slug" => 'product.barcode',
            ],
            //Customer
            [
                "title" => 'Customer List',
                "slug" => 'customer.index',
            ],
            [
                "title" => 'Customer Create View',
                "slug" => 'customer.create',
            ],
            [
                "title" => 'Create Customer',
                "slug" => 'customer.store',
            ],
            [
                "title" => 'Customer Edit View',
                "slug" => 'customer.edit',
            ],
            [
                "title" => 'Update Customer',
                "slug" => 'customer.update',
            ],
            [
                "title" => 'Delete Customer',
                "slug" => 'customer.destroy',
            ],
            [
                "title" => 'Customer Info',
                "slug" => 'customer.show',
            ],

            //Membership Type
            [
                "title" => 'Membership Type List',
                "slug" => 'membership-type.index',
            ],
            [
                "title" => 'Membership Type Create View',
                "slug" => 'membership-type.create',
            ],
            [
                "title" => 'Create Membership Type',
                "slug" => 'membership-type.store',
            ],
            [
                "title" => 'Membership Type Edit View',
                "slug" => 'membership-type.edit',
            ],
            [
                "title" => 'Update Membership Type',
                "slug" => 'membership-type.update',
            ],
            [
                "title" => 'Delete Membership Type',
                "slug" => 'membership-type.destroy',
            ],
            [
                "title" => 'Membership Type Info',
                "slug" => 'membership-type.show',
            ],

            //Member
            [
                "title" => 'Member List',
                "slug" => 'member.index',
            ],
            [
                "title" => 'Member Create View',
                "slug" => 'member.create',
            ],
            [
                "title" => 'Create Member',
                "slug" => 'member.store',
            ],
            [
                "title" => 'Member Edit View',
                "slug" => 'member.edit',
            ],
            [
                "title" => 'Update Member',
                "slug" => 'member.update',
            ],
            [
                "title" => 'Delete Member',
                "slug" => 'member.destroy',
            ],
            [
                "title" => 'Member Info',
                "slug" => 'member.show',
            ],

            //Order
            [
                "title" => 'Order List',
                "slug" => 'order.index',
            ],
            [
                "title" => 'Order Create View',
                "slug" => 'order.create',
            ],
            [
                "title" => 'Create Order',
                "slug" => 'order.store',
            ],
            [
                "title" => 'Order Edit View',
                "slug" => 'order.edit',
            ],
            [
                "title" => 'Update Order',
                "slug" => 'order.update',
            ],
            [
                "title" => 'Delete Order',
                "slug" => 'order.destroy',
            ],
            [
                "title" => 'Order Info',
                "slug" => 'order.show',
            ],
            //Order With Scanner
            [
                "title" => 'Order With Scanner List',
                "slug" => 'order.pos.index',
            ],
            [
                "title" => 'Order With Scanner Create View',
                "slug" => 'order.pos.create',
            ],
            [
                "title" => 'Create Order With Scanner',
                "slug" => 'order.pos.store',
            ],
            [
                "title" => 'Order With Scanner Edit View',
                "slug" => 'order.pos.edit',
            ],
            [
                "title" => 'Update Order With Scanner',
                "slug" => 'order.pos.update',
            ],
            [
                "title" => 'Delete Order With Scanner',
                "slug" => 'order.pos.destroy',
            ],
            [
                "title" => 'Order With Scanner Info',
                "slug" => 'order.pos.show',
            ],
            [
                "title" => 'Sell Return List',
                "slug" => 'order.pos.sellReturn',
            ],
            //Stock In
            [
                "title" => 'Stock In List',
                "slug" => 'stock-in.index',
            ],
            [
                "title" => 'Stock In Create View',
                "slug" => 'stock-in.create',
            ],
            [
                "title" => 'Create Stock In',
                "slug" => 'stock-in.store',
            ],
            [
                "title" => 'Stock In Edit View',
                "slug" => 'stock-in.edit',
            ],
            [
                "title" => 'Update Stock In',
                "slug" => 'stock-in.update',
            ],
            [
                "title" => 'Delete Stock In',
                "slug" => 'stock-in.destroy',
            ],
            [
                "title" => 'Stock In Info',
                "slug" => 'stock-in.show',
            ],
            //Stock In
            [
                "title" => 'Stock In With Scanner',
                "slug" => 'stockIn.pos.index',
            ],
            [
                "title" => 'Stock In With Scanner Create View',
                "slug" => 'stockIn.pos.create',
            ],
            [
                "title" => 'Create Stock In With Scanner',
                "slug" => 'stockIn.pos.store',
            ],
            [
                "title" => 'Stock In With Scanner Edit View',
                "slug" => 'stockIn.pos.edit',
            ],
            [
                "title" => 'Update Stock In With Scanner',
                "slug" => 'stockIn.pos.update',
            ],
            [
                "title" => 'Delete Stock In With Scanner',
                "slug" => 'stockIn.pos.destroy',
            ],
            [
                "title" => 'Stock In With Scanner Info',
                "slug" => 'stockIn.pos.show',
            ],
            // SMS Template
            [
                "title" => 'Sms Template List',
                "slug" => 'sms-template.index',
            ],
            [
                "title" => 'Sms Template Create View',
                "slug" => 'sms-template.create',
            ],
            [
                "title" => 'Create Sms Template',
                "slug" => 'sms-template.store',
            ],
            [
                "title" => 'Sms Template Edit View',
                "slug" => 'sms-template.edit',
            ],
            [
                "title" => 'Update Sms Template',
                "slug" => 'sms-template.update',
            ],
            [
                "title" => 'Delete Sms Template',
                "slug" => 'sms-template.destroy',
            ],
            [
                "title" => 'Sms Template Info',
                "slug" => 'sms-template.show',
            ],
            [
                "title" => 'Send Sms Template',
                "slug" => 'sms-template.send',
            ],
            // SMS
            [
                "title" => 'Sms List',
                "slug" => 'sms.index',
            ],
            [
                "title" => 'Sms Create View',
                "slug" => 'sms.create',
            ],
            [
                "title" => 'Create Sms',
                "slug" => 'sms.store',
            ],
            [
                "title" => 'Delete Sms',
                "slug" => 'sms.destroy',
            ],
            [
                "title" => 'Sms Info',
                "slug" => 'sms.show',
            ],

            // OFFER
            [
                "title" => 'Offer List',
                "slug" => 'offer.index',
            ],
            [
                "title" => 'Offer Create View',
                "slug" => 'offer.create',
            ],
            [
                "title" => 'Create Offer',
                "slug" => 'offer.store',
            ],
            [
                "title" => 'Offer Edit View',
                "slug" => 'offer.edit',
            ],
            [
                "title" => 'Update Offer',
                "slug" => 'offer.update',
            ],
            [
                "title" => 'Delete Offer',
                "slug" => 'offer.destroy',
            ],
            [
                "title" => 'Offer Info',
                "slug" => 'offer.show',
            ],
            // Damage Without Scanner
            [
                "title" => 'Damage List',
                "slug" => 'damage.index',
            ],
            [
                "title" => 'Damage Create View',
                "slug" => 'damage.create',
            ],
            [
                "title" => 'Create Damage',
                "slug" => 'damage.store',
            ],
            [
                "title" => 'Damage Edit View',
                "slug" => 'damage.edit',
            ],
            [
                "title" => 'Update Damage',
                "slug" => 'damage.update',
            ],
            [
                "title" => 'Delete Damage',
                "slug" => 'damage.destroy',
            ],
            [
                "title" => 'Damage Info',
                "slug" => 'damage.show',
            ],
            //Order With Scanner
            [
                "title" => 'Damage With Scanner List',
                "slug" => 'damage.pos.index',
            ],
            [
                "title" => 'Damage With Scanner Create View',
                "slug" => 'damage.pos.create',
            ],
            [
                "title" => 'Create Damage With Scanner',
                "slug" => 'damage.pos.store',
            ],
            [
                "title" => 'Damage With Scanner Edit View',
                "slug" => 'damage.pos.edit',
            ],
            [
                "title" => 'Update Damage With Scanner',
                "slug" => 'damage.pos.update',
            ],
            [
                "title" => 'Delete Damage With Scanner',
                "slug" => 'damage.pos.destroy',
            ],
            [
                "title" => 'Damage With Scanner Info',
                "slug" => 'damage.pos.show',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
