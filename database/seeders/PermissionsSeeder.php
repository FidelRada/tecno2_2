<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

use App\Models\CategoriaInsumo;
use App\Models\Insumo;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        Permission::create(['name' => 'ver lista de posts']);
        $role1 = Role::create(['name' => 'pruebaposts']);
        $role1->givePermissionTo('ver lista de posts');
        */


        //$roleX = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        /*
        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unpublish articles');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
*/

        // create demo users - Admin
        /*
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
            'telefono' => '78458123',
        ]);
        $user->assignRole($roleX);
        */



        /*
        $categoriainsumo1 = \App\Models\CategoriaInsumo::factory()->create([
            'nombre' => 'tinta para impresion',
            'descripcion' => 'esta son las tintas para la impresion'            
        ]);

        $categoriainsumo2 = \App\Models\CategoriaInsumo::factory()->create([
            'nombre' => 'papel para impresion',
            'descripcion' => 'esta son los paleles para la impresion'            
        ]);
        */

        /*
        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);
        */
        
        //Usuarios Iniciales:
        //Admin:
        $roleAdmin = Role::create(['name' => 'Super-Admin']);
        /*
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'apellidopaterno' => 'AdminP',
            'apellidomaterno' => 'AdminM',
            'ci' => '9885541',
            'telefono' => '78458123',
            'direccion' => 'B/Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        $user->removeRole('Cliente');        
        $user->assignRole($roleAdmin);
        */

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        //$user->removeRole('Cliente');        
        $user->assignRole($roleAdmin);


        //Cliente
        /*
        $user = \App\Models\User::factory()->create([
            'name' => 'Cliente',
            'apellidopaterno' => 'ClienteP',
            'apellidomaterno' => 'ClienteM',
            'ci' => '2124541',
            'telefono' => '658458123',
            'direccion' => 'B/Cliente',
            'email' => 'cliente@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        $user->removeRole('Cliente');
        $user->assignRole($roleCliente);
        */
        $roleCliente = Role::create(['name' => 'Cliente']);
        $user = \App\Models\User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        //$user->removeRole('Cliente');
        $user->assignRole($roleCliente);

        //Empleado
        /*
        $roleEmpleado = Role::create(['name' => 'Empleado']);
        $user = \App\Models\User::factory()->create([
            'name' => 'Empleado',
            'apellidopaterno' => 'EmpleadoP',
            'apellidomaterno' => 'EmpleadoM',
            'ci' => '0245541',
            'telefono' => '69858123',
            'direccion' => 'B/Empleado',
            'email' => 'empleado@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        $user->removeRole('Cliente');
        $user->assignRole($roleEmpleado);
        */

        $roleEmpleado = Role::create(['name' => 'Empleado']);
        $user = \App\Models\User::factory()->create([
            'name' => 'Empleado',
            'email' => 'empleado@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        //$user->removeRole('Cliente');
        $user->assignRole($roleEmpleado);

        //Proveedor
        /*
        $roleProveedor = Role::create(['name' => 'Proveedor']);
        $user = \App\Models\User::factory()->create([
            'name' => 'Proveedor',
            'apellidopaterno' => 'ProveedorP',
            'apellidomaterno' => 'ProveedorM',
            'ci' => '02854612',
            'telefono' => '69845123',
            'direccion' => 'B/Proveedor',
            'email' => 'proveedor@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        $user->removeRole('Cliente');
        $user->assignRole($roleProveedor);
        */

        $roleProveedor = Role::create(['name' => 'Proveedor']);
        $user = \App\Models\User::factory()->create([
            'name' => 'Proveedor',
            'email' => 'proveedor@test.com',
            'password' => Hash::make('12345678'),            
        ]);
        //$user->removeRole('Cliente');
        $user->assignRole($roleProveedor);

        //Lista de Permisos:

        //Acceso a pestañas

        
        Permission::create(['name' => 'ver pestaña de gestion de usuarios']);
        Permission::create(['name' => 'ver pestaña de gestion de clientes']);
        Permission::create(['name' => 'ver pestaña de gestion de empleados']);
        Permission::create(['name' => 'ver pestaña de gestion de proveedores']);
        Permission::create(['name' => 'ver pestaña de gestion de roles']);

        Permission::create(['name' => 'ver pestaña de gestion de insumos']);
        Permission::create(['name' => 'ver pestaña de categoria de insumos']);
        Permission::create(['name' => 'ver pestaña de insumos']);

        Permission::create(['name' => 'ver pestaña de gestion de inventarios']);
        Permission::create(['name' => 'ver pestaña de ingresos']);
        Permission::create(['name' => 'ver pestaña de egresos']);

        Permission::create(['name' => 'ver pestaña de gestion de servicios']);        

        Permission::create(['name' => 'ver pestaña de gestion de plantillas de diseño']);
        Permission::create(['name' => 'ver pestaña de categorias de diseño']);
        Permission::create(['name' => 'ver pestaña de subcategorias de diseño']);
        Permission::create(['name' => 'ver pestaña de plantillas de diseño']);

        Permission::create(['name' => 'ver pestaña de gestion de pagos']);
        Permission::create(['name' => 'ver pestaña de metodos de pagos']);
        

        //$roleCliente->givePermissionTo('');
        //$roleEmpleado->givePermissionTo(''); 
        //$roleProveedor->givePermissionTo('');

        $roleCliente->givePermissionTo('ver pestaña de gestion de usuarios');
        $roleCliente->givePermissionTo('ver pestaña de gestion de clientes');

        $roleEmpleado->givePermissionTo('ver pestaña de gestion de usuarios');
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de clientes'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de empleados'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de proveedores'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de roles'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de insumos'); 
        $roleEmpleado->givePermissionTo('ver pestaña de categoria de insumos'); 
        $roleEmpleado->givePermissionTo('ver pestaña de insumos'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de inventarios'); 
        $roleEmpleado->givePermissionTo('ver pestaña de ingresos'); 
        $roleEmpleado->givePermissionTo('ver pestaña de egresos'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de servicios'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de plantillas de diseño'); 
        $roleEmpleado->givePermissionTo('ver pestaña de categorias de diseño'); 
        $roleEmpleado->givePermissionTo('ver pestaña de subcategorias de diseño'); 
        $roleEmpleado->givePermissionTo('ver pestaña de plantillas de diseño'); 
        $roleEmpleado->givePermissionTo('ver pestaña de gestion de pagos'); 
        $roleEmpleado->givePermissionTo('ver pestaña de metodos de pagos'); 
        
        $roleProveedor->givePermissionTo('ver pestaña de gestion de insumos');
        $roleProveedor->givePermissionTo('ver pestaña de categoria de insumos');
        $roleProveedor->givePermissionTo('ver pestaña de insumos');
        $roleProveedor->givePermissionTo('ver pestaña de gestion de inventarios');
        $roleProveedor->givePermissionTo('ver pestaña de ingresos');
        
        


        

        



        //Usuarios->Usuarios, Clientes y Empleados
        

        Permission::create(['name' => 'ver lista de clientes']);
        Permission::create(['name' => 'ver lista de empleados']);
        Permission::create(['name' => 'ver lista de proveedores']);

        Permission::create(['name' => 'añadir un nuevo cliente']);
        Permission::create(['name' => 'añadir un nuevo empleado']);
        Permission::create(['name' => 'añadir un nuevo proveedor']);

        Permission::create(['name' => 'editar clientes']);
        Permission::create(['name' => 'editar empleados']);
        Permission::create(['name' => 'editar proveedores']);

        Permission::create(['name' => 'eliminar clientes']);
        Permission::create(['name' => 'eliminar empleados']);
        Permission::create(['name' => 'eliminar proveedores']);

        //Usuarios->Roles y Permisos

        Permission::create(['name' => 'ver lista de roles']);
        Permission::create(['name' => 'ver lista de permisos']);

        Permission::create(['name' => 'añadir un nuevo rol']);        

        Permission::create(['name' => 'editar un rol']);        

        Permission::create(['name' => 'eliminar un rol']);
        Permission::create(['name' => 'eliminar un permiso']);

        //Insumos

        Permission::create(['name' => 'ver lista de categorias de insumos']);
        Permission::create(['name' => 'ver lista de insumos']);

        Permission::create(['name' => 'añadir una nueva categoria de insumo']);
        Permission::create(['name' => 'añadir un nuevo insumo']);

        Permission::create(['name' => 'editar una categoria de insumo']);
        Permission::create(['name' => 'editar un insumo']);

        Permission::create(['name' => 'eliminar una categoria de insumo']);
        Permission::create(['name' => 'eliminar un insumo']);

        //Inventarios

        Permission::create(['name' => 'ver lista de ingresos']);
        Permission::create(['name' => 'ver lista de egresos']);

        Permission::create(['name' => 'añadir un nuevo ingreso']);
        Permission::create(['name' => 'añadir un nuevo egreso']);

        //Plantilla de Diseño

        Permission::create(['name' => 'ver lista de categorias de diseño']);
        Permission::create(['name' => 'ver lista de subcategorias de diseño']);
        Permission::create(['name' => 'ver lista de plantillas de diseño']);

        Permission::create(['name' => 'añadir una nueva categoria de diseño']);
        Permission::create(['name' => 'añadir una nueva subcategoria de diseño']);
        Permission::create(['name' => 'añadir una nueva plantilla de diseño']);

        Permission::create(['name' => 'editar una categoria de diseño']);
        Permission::create(['name' => 'editar una subcategoria de diseño']);
        Permission::create(['name' => 'editar una plantilla de diseño']);

        Permission::create(['name' => 'eliminar una categoria de diseño']);
        Permission::create(['name' => 'eliminar una subcategoria de diseño']);
        Permission::create(['name' => 'eliminar una plantilla de diseño']);

        //Servicio

        Permission::create(['name' => 'ver lista de servicios']);
        Permission::create(['name' => 'añadir un nuevo servicio']);
        Permission::create(['name' => 'editar un servicio']);
        Permission::create(['name' => 'eliminar un servicio']);

        //Pedido ->TBD<-

        //Pagos ->TBD<-
        Permission::create(['name' => 'ver lista de metodos de pago']);
        Permission::create(['name' => 'añadir un nuevo metodo de pago']);
        Permission::create(['name' => 'editar un metodo de pago']);
        Permission::create(['name' => 'eliminar un metodo de pago']);


        //Reportes y Estadisticas ->TBD<-


        //Asignacion de Permisos a los roles:
        
        //Cliente
        $roleCliente->givePermissionTo('añadir un nuevo cliente');
        $roleCliente->givePermissionTo('ver lista de categorias de diseño');
        $roleCliente->givePermissionTo('ver lista de subcategorias de diseño');
        $roleCliente->givePermissionTo('ver lista de plantillas de diseño');
        $roleCliente->givePermissionTo('ver lista de servicios');
        //$roleCliente->givePermissionTo('');
        
        

        //Empleado
        $roleEmpleado->givePermissionTo('ver lista de clientes');
        $roleEmpleado->givePermissionTo('ver lista de empleados');
        $roleEmpleado->givePermissionTo('ver lista de proveedores');
        $roleEmpleado->givePermissionTo('añadir un nuevo cliente');
        $roleEmpleado->givePermissionTo('añadir un nuevo empleado');
        $roleEmpleado->givePermissionTo('añadir un nuevo proveedor');
        $roleEmpleado->givePermissionTo('editar clientes');
        $roleEmpleado->givePermissionTo('editar empleados');        
        $roleEmpleado->givePermissionTo('editar proveedores');
        $roleEmpleado->givePermissionTo('eliminar clientes');        
        $roleEmpleado->givePermissionTo('eliminar empleados');
        $roleEmpleado->givePermissionTo('eliminar proveedores');        
        $roleEmpleado->givePermissionTo('ver lista de roles');
        $roleEmpleado->givePermissionTo('ver lista de permisos');        
        $roleEmpleado->givePermissionTo('añadir un nuevo rol');
        $roleEmpleado->givePermissionTo('editar un rol');        
        $roleEmpleado->givePermissionTo('eliminar un rol');
        $roleEmpleado->givePermissionTo('eliminar un permiso');        
        $roleEmpleado->givePermissionTo('ver lista de categorias de insumos');
        $roleEmpleado->givePermissionTo('ver lista de insumos');        
        $roleEmpleado->givePermissionTo('añadir una nueva categoria de insumo');
        $roleEmpleado->givePermissionTo('añadir un nuevo insumo');        
        $roleEmpleado->givePermissionTo('editar una categoria de insumo');
        $roleEmpleado->givePermissionTo('editar un insumo');        
        $roleEmpleado->givePermissionTo('eliminar una categoria de insumo');
        $roleEmpleado->givePermissionTo('eliminar un insumo');        
        $roleEmpleado->givePermissionTo('ver lista de ingresos');
        $roleEmpleado->givePermissionTo('ver lista de egresos');        
        $roleEmpleado->givePermissionTo('añadir un nuevo egreso');
        $roleEmpleado->givePermissionTo('ver lista de categorias de diseño');
        $roleEmpleado->givePermissionTo('ver lista de subcategorias de diseño');
        $roleEmpleado->givePermissionTo('ver lista de plantillas de diseño');
        $roleEmpleado->givePermissionTo('añadir una nueva categoria de diseño');        
        $roleEmpleado->givePermissionTo('añadir una nueva subcategoria de diseño');
        $roleEmpleado->givePermissionTo('añadir una nueva plantilla de diseño');        
        $roleEmpleado->givePermissionTo('editar una categoria de diseño');
        $roleEmpleado->givePermissionTo('editar una subcategoria de diseño');        
        $roleEmpleado->givePermissionTo('editar una plantilla de diseño');
        $roleEmpleado->givePermissionTo('eliminar una categoria de diseño');        
        $roleEmpleado->givePermissionTo('eliminar una subcategoria de diseño');
        $roleEmpleado->givePermissionTo('eliminar una plantilla de diseño');        
        $roleEmpleado->givePermissionTo('ver lista de servicios');
        $roleEmpleado->givePermissionTo('añadir un nuevo servicio');
        $roleEmpleado->givePermissionTo('editar un servicio');        
        $roleEmpleado->givePermissionTo('eliminar un servicio');        
        //$roleEmpleado->givePermissionTo('');        

        
        //Proveedor
        $roleProveedor->givePermissionTo('ver lista de categorias de insumos');
        $roleProveedor->givePermissionTo('ver lista de insumos');
        $roleProveedor->givePermissionTo('añadir un nuevo ingreso');
        //$roleProveedor->givePermissionTo('');
        
        


        $categoriainsumo = CategoriaInsumo::create([
            'nombre' => 'tinta para impresoras',
            'descripcion' => 'tintas para ser usadas por las impresoras'            
        ]);

        $categoriainsumo = CategoriaInsumo::create([
            'nombre' => 'papel para impresoras',
            'descripcion' => 'papel para ser usados por las impresoras'            
        ]);

        $insumo = Insumo::create([
            'categoria_insumo_id' => 1,
            'nombre' => 'Tinta XL',
            'marca' => 'Cannon',
            'descripcion' => 'tinta de marca cannon para la impresion de disenos',
            'preciocompra' => 20.5,  
            'precioventa' => 0,            
            'porcentajeventa' => 0.20,
            'cantidaddisponible' => 30            
        ]);

        $insumo = Insumo::create([
            'categoria_insumo_id' => 2,
            'nombre' => 'Papel PVC',
            'marca' => 'Colorful',
            'descripcion' => 'papel de la marca colorful la impresion de disenos',
            'preciocompra' => 30.2,  
            'precioventa' => 0,            
            'porcentajeventa' => 0.25,
            'cantidaddisponible' => 100            
        ]);

        //Run Migrations

        //php artisan migrate:fresh --seed --seeder=PermissionsSeeder

    }
}
