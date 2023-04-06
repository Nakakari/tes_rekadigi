<?php

return [
    'authorities' => [
        'manage_menu' => [
            'menu_dashboard',
            'menu_beranda',
            'menu_user',
            'menu_role',
            'menu_kategori',
            'menu_pendampingan',
            'menu_jenismitra',
            'menu_mitra',
            'menu_persebaran',
            'menu_berita',
            'menu_kegiatan',
            'menu_produk',
            'menu_unit',
            'menu_chat',
        ],
        'manage_beranda' => [
            'beranda_show',
            'beranda_create',
            'beranda_update',
            'beranda_detail',
            'beranda_delete'
        ],
        'manage_kategoripostingan' => [
            'kategoripostingan_show',
            'kategoripostingan_create',
            'kategoripostingan_update',
            'kategoripostingan_detail',
            'kategoripostingan_delete'
        ],
        'manage_mitra' => [
            'mitra_show',
            'mitra_create',
            'mitra_update',
            'mitra_detail',
            'mitra_delete'
        ],
        'manage_persebaranmitra' => [
            'persebaranmitra_show',
            'persebaranmitra_create',
            'persebaranmitra_update',
            'persebaranmitra_detail',
            'persebaranmitra_delete'
        ],
        'manage_jenismitra' => [
            'jenismitra_show',
            'jenismitra_create',
            'jenismitra_update',
            'jenismitra_detail',
            'jenismitra_delete'
        ],
        'manage_pendampingan' => [
            'pendampingan_show',
            'pendampingan_create',
            'pendampingan_update',
            'pendampingan_detail',
            'pendampingan_delete'
        ],
        'manage_unit' => [
            'unit_show',
            'unit_create',
            'unit_update',
            'unit_detail',
            'unit_delete'
        ],
        'manage_berita' => [
            'berita_show',
            'berita_create',
            'berita_update',
            'berita_detail',
            'berita_delete',
            'berita_isaktif'
        ],
        'manage_kegiatan' => [
            'kegiatan_show',
            'kegiatan_create',
            'kegiatan_update',
            'kegiatan_detail',
            'kegiatan_delete',
            'kegiatan_isaktif'
        ],
        'manage_produk' => [
            'produk_show',
            'produk_create',
            'produk_update',
            'produk_detail',
            'produk_delete',
            'produk_isaktif'
        ],
        'manage_komentar' => [
            'komentar_show',
            'komentar_create',
        ],
        'manage_chat' => [
            'chat_show',
            'chat_create',
        ],
        'manage_roles' => [
            'role_show',
            'role_create',
            'role_update',
            'role_detail',
            'role_delete'
        ],
        'manage_users' => [
            'user_show',
            'user_create',
            'user_update',
            'user_detail',
            'user_delete',
            'user_isaktif'
        ],
        'manage_profil' => [
            'profil_show',
            'profil_update',
        ],
    ],
    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];
