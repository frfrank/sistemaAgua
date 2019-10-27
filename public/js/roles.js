var myApp = angular.module('myApp', []);

myApp.controller('MyController', ['$scope', '$http', function ($scope, $http) {
    $scope.modal = 0;
    $scope.tituloModal = '';
    $scope.nombre = '';
    $scope.descripcion = '';
    $scope.roles_id = 0,
    $scope.error = '';
    $scope.elementos = [];
    $scope.pagination = {
        'total': 0,
        'current_page': 0,
        'per_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0,
    },
        $scope.offset = 3;
    $scope.buscar = '';
    $scope.id='';
    $scope.ordenarPor='';
    $scope.arregloNombres=[];
    var respuesta;


//function para listar todos los registros
    $scope.listarRoles = (page,buscar) => {
        $http.get('/roles/listarRoles?page=' + page +'&buscar='+ buscar) //Esta ruta ya la tengo definida
            .then(function (response) {
                respuesta = response.data;
                $scope.elementos = respuesta.roles.data;
                $scope.pagination = respuesta.pagination;
                $scope.pages = $scope.pagesNumber();
                $scope.totalRegistros = respuesta.pagination.total;
                return respuesta;

            });
    }
    $scope.listarRoles(1,$scope.buscar='');
    
    //De esta maner declaro una funcion
    $scope.abrirModal = (modelo, opcion, data = []) => {
        if (modelo == "rol") {
            if (opcion == 'nuevo') {
                $scope.modal = 1;
                $scope.nombre = '';
                $scope.descripcion = '';
                $scope.estado = 1;
                $scope.tituloModal = "Nuevo Registro";
                $scope.botonGuardar = true;

                if ($scope.nombre == '') {
                    $scope.isValido = 'is-valid';
                }

            }
        }
        if (modelo == "rol") {
            if (opcion == "actualizar") {
                $scope.modal = 1;
                $scope.roles_id = data['id'];
                $scope.nombre = data['nombre'];
                $scope.descripcion = data['descripcion'];
                $scope.estado = data['estado'];
                $scope.tituloModal = "Actualizar Registro";
                $scope.botonGuardar = false;
            }
        }
    },
        $scope.cerrarModal = () => {
            $scope.modal = 0;
            $scope.nombre = '';
            $scope.descripcion = '';
            $scope.errorMostrarMsj = '';
        },
//Function para guardar un registro utlizando promesa
        $scope.guardarRol = () => {
            $scope.validarDatos();
            $scope.verificarNombre('guardar');
            $http.post('/roles/guardarRoles', {
                nombre: $scope.nombre,
                descripcion: $scope.descripcion,
                estado: $scope.estado

            }).then(function mySuccess(response) {
                    Swal.fire({
                        //position: 'top-end',
                        type: 'success',
                        title: 'Guardado Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $scope.listarRoles(1,$scope.buscar);
                    $scope.cerrarModal();

                }, function myError(response) {
                    console.log("error");


                }
            )
        }
        //Verficar Nombre
       $scope.verificarNombre=(opcion)=>{
        $http.get('/roles/listaVerificarNombre') //Esta ruta ya la tengo definida
        .then(function (response) {
            $scope.arregloNombres = response.data;
            var arreglo=$scope.arregloNombres;
        
        if(opcion=='guardar'){
            var nombre='nombre';
            for(var i=0;i<arreglo.length;i++){
                 var nombre='nombre';                
                    if(arreglo[i][nombre]==$scope.nombre){
                        alertify.error('ERROR AL GUARDAR: el rol ya existe',);
                    }
                }
        }  
        
        if(opcion=='actualizar'){
            var nombre='nombre';
            for(var i=0;i<arreglo.length;i++){
                 var nombre='nombre';
                 var id='id';                
                    if(arreglo[i][nombre]==$scope.nombre && arreglo[i][id]!=$scope.roles_id){
                        alertify.error('ERROR AL ACTUALIZAR: el rol ya existe',);
                    }
                }
        }               
       
        });
       } 
       

//Funtion para actualizar un Registro
    $scope.actualizarRol = () => {
        //console.log("Funcion de actualizar datos");
        $scope.validarDatos();
        $scope.verificarNombre('actualizar');
        $http.put('/roles/actualizarRoles', {
            nombre: $scope.nombre,
            descripcion: $scope.descripcion,
            estado: $scope.estado,
            id: $scope.roles_id

        }).then(function mySuccess(response) {
            Swal.fire({
                //	position: 'top-end',
                type: 'success',
                title: 'Actualizado Exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
            $scope.listarRoles(1,$scope.buscar);
            $scope.cerrarModal();

        }, function myError(response) {
            console.log("error", response);

        })
    }
    $scope.desactivarRol=(data=[])=>{
        Swal.fire({
            title: 'Estas Seguro?',
            text: "Quieres desactivar el Registro!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Desactivar!'
          }).then((result) => {
            if (result.value) {
                $scope.id=data['id'];
            $http.put('/roles/desactivar', {
                id: $scope.id  
            }).then(function mySuccess(response) {
                 $scope.listarRoles(1,$scope.buscar);              

            }, function myError(response) {
                console.log("error", response);
            })
              Swal.fire(
                'Desactivado!',
                'Desactivado Exitosamente.',
                'success'
              )
            }
          });
        
    }
    $scope.activarRol=(data=[])=>{
        Swal.fire({
            title: 'Estas Seguro?',
            text: "Quieres Activar el Registro!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Activar!'
          }).then((result) => {
            if (result.value) {
                $scope.id=data['id'];
            $http.put('/roles/activar', {id: $scope.id  
            }).then(function mySuccess(response) {
                 $scope.listarRoles(1,$scope.buscar);              

            }, function myError(response) {
                console.log("error", response);
            })
              Swal.fire(
                'Activado!',
                'Activado Exitosamente.',
                'success'
              )
            }
          });
        
    }
  
    $scope.validarDatos = () => {
        $scope.errorMostrarMsj;

        if (!$scope.nombre) {
            $scope.errorMostrarMsj = "El campo Nombre no puede quedar Vacio";
            $scope.isInvalido = 'is-invalid';
        }

        return $scope.errorMostrarMsj;

    }
    $scope.isActived = () => {
        return $scope.pagination.current_page;
    }
//Calcular Los Elementos de la paginacion
    $scope.pagesNumber = () => {
        if (!$scope.pagination.to) {
            return [];
        }

        var from = $scope.pagination.current_page - $scope.offset;
        if (from < 1) {
            from = 1;
        }

        var to = from + ($scope.offset * 2);
        if (to >= $scope.pagination.last_page) {
            to = $scope.pagination.last_page;
        }

        var pagesArray = [];
        while (from <= to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;

    }
    $scope.cambiarPagina = (page) => {
        $scope.pagination.current_page = page;
        $scope.listarRoles(page,$scope.buscar);
    }
    $scope.ordenar=(parametro)=>{
        if(parametro=="ordenarMenorAMayor"){
         $scope.ordenarPor='nombre';
         $scope.mostrar=0;
       
        }
         if(parametro=="ordenarMayorAMenor"){
            $scope.ordenarPor='-nombre';
            $scope.mostrar=1;
         
        }
        if(parametro=="ordenarMenorAMayorDescripcion"){
            $scope.ordenarPor='descripcion';
            $scope.mostrar=0;
        }
        if(parametro=="ordenarMayorAMenorDescripcion"){
            $scope.ordenarPor='-descripcion';
            $scope.mostrar=1;
        }
         
    }
    
}]);


