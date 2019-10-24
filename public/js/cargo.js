var myApp = angular.module('myApp', []);

myApp.controller('MyController', ['$scope', '$http', function ($scope, $http) {
    $scope.modal = 0;
    $scope.tituloModal = '';
    $scope.nombre = '';
    $scope.descripcion = '';
    $scope.cargo_id = 0,
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
    $scope.listarcargos = (page,buscar) => {
        $http.get('/cargo/listacargo?page=' + page +'&buscar='+ buscar) //Esta ruta ya la tengo definida
            .then(function (response) {
                respuesta = response.data;
                $scope.elementos = respuesta.cargo.data;
                $scope.pagination = respuesta.pagination;
                $scope.pages = $scope.pagesNumber();
                $scope.totalRegistros = respuesta.pagination.total;
               console.log($scope.elementos);
                return respuesta;

            });
    }
    $scope.listarcargos(1,$scope.buscar='');
    
    //De esta maner declaro una funcion
    $scope.abrirModal = (modelo, opcion, data = []) => {
        if (modelo == "cargo") {
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
        if (modelo == "cargo") {
            if (opcion == "actualizar") {
                $scope.modal = 1;
                $scope.cargo_id = data['id'];
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
        $scope.guardarCargo = () => {
            $scope.validarDatos();
            $scope.verificarNombre('guardar');
            $http.post('/cargo/guardarcargo', {
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
                    $scope.listarcargos(1,$scope.buscar);
                    $scope.cerrarModal();

                }, function myError(response) {
                    console.log("error");


                }
            )
        }
        //Verficar Nombre
       $scope.verificarNombre=(opcion)=>{
        $http.get('/cargo/listaVerificarNombre') //Esta ruta ya la tengo definida
        .then(function (response) {
            $scope.arregloNombres = response.data;
            var arreglo=$scope.arregloNombres;
        
        if(opcion=='guardar'){
            var nombre='nombre';
            for(var i=0;i<arreglo.length;i++){
                 var nombre='nombre';                
                    if(arreglo[i][nombre]==$scope.nombre){
                        alertify.error('ERROR AL GUARDAR: el cargo ya existe',);
                    }
                }
        }  
        
        if(opcion=='actualizar'){
            var nombre='nombre';
            for(var i=0;i<arreglo.length;i++){
                 var nombre='nombre';                
                    if(arreglo[i][nombre]==$scope.nombre){
                        alertify.error('ERROR AL ACTUALIZAR: el cargo ya existe',);
                    }
                }
        }               
       
        });
       } 
       

//Funtion para actualizar un Registro
    $scope.actualizarCargo = () => {
        //console.log("Funcion de actualizar datos");
        $scope.validarDatos();
        $scope.verificarNombre('actualizar');
        $http.put('/cargo/actualizarcargo', {
            nombre: $scope.nombre,
            descripcion: $scope.descripcion,
            estado: $scope.estado,
            id: $scope.cargo_id

        }).then(function mySuccess(response) {
            Swal.fire({
                //	position: 'top-end',
                type: 'success',
                title: 'Actualizado Exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
            $scope.listarcargos(1,$scope.buscar);
            $scope.cerrarModal();

        }, function myError(response) {
            console.log("error", response);

        })
    }
    $scope.eliminarCargo=(data=[])=>{
        Swal.fire({
            title: 'Estas Seguro?',
            text: "Quieres eliminar el Registro!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
          }).then((result) => {
            if (result.value) {
                $scope.id=data['id'];
            $http.post('/cargo/eliminarCargo', {id: $scope.id  
            }).then(function mySuccess(response) {
                console.log(data['id']);
                 $scope.listarcargos(1,$scope.buscar);              

            }, function myError(response) {
                console.log("error", response);
            })
              Swal.fire(
                'Eliminado!',
                'Eliminado Exitosamente.',
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
        $scope.listarcargos(page,$scope.buscar);
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
    $scope.animarBarra=()=>{
        document.getElementById("barra").classList.toggle("finbarra");

    }
$scope.animarBarra();

}]);


