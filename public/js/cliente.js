var myApp = angular.module('myApp', []);

myApp.controller('MyController', ['$scope', '$http', function ($scope, $http) {
    $scope.nombre = '';
    $scope.apellido='';
    $scope.telefono='';
    $scope.tipoDocumento='CEDULA';
    $scope.cedula='';
    $scope.edad='';
    $scope.descripcion = '';
    $scope.direccion='';
    $scope.comunidad='';
    $scope.estado='1';
    $scope.mostrar='0';
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
    $scope.arregloCedula=[];
    var respuesta;
    var digitosCedula;
    var elementos;
    var arregloObtenido;
    var arregloCodigo;
    var codigoMunicipio;
    var convertir;
    var dia;
    var mes;
    var anio;    
    var fecha = new Date();
    var anioActual = fecha.getFullYear();
    var sigloxx=parseInt(anioActual)-2000;
    var anioNacimiento;
    var mesActual = fecha.getMonth() + 1;
    var diaActual = fecha.getDate();
    var edad;
    



//function para listar todos los registros
    $scope.listarclientes = (page,buscar) => {
        $http.get('/cliente/listaClientes?page=' + page +'&buscar='+ buscar) //Esta ruta ya la tengo definida
            .then(function (response) {
                respuesta = response.data;
                $scope.elementos = respuesta.persona.data;
                $scope.pagination = respuesta.pagination;
                $scope.pages = $scope.pagesNumber();
                $scope.totalRegistros = respuesta.pagination.total;
                return respuesta;

            });
    }
    $scope.listarclientes(1,$scope.buscar='');
    
   $scope.listarComunidades=()=>{
       $http.get('/cliente/listarComunidad')
            .then(function (response){
                $scope.comunidades=response.data;
            })
   }
   $scope.mostrarFormulario=()=>{
    $scope.mostrar=1;
    $scope.nombre = '';
    $scope.apellido='';
    $scope.telefono='';
    $scope.tipoDocumento='CEDULA';
    $scope.cedula='';
    $scope.edad='';
    $scope.descripcion = '';
    $scope.direccion='';
    $scope.comunidad='';
    
   }
   $scope.ocultarFormulario=()=>{
    $scope.mostrar=0;
    $scope.nombre = '';
    $scope.apellido='';
    $scope.telefono='';
    $scope.tipoDocumento='CEDULA';
    $scope.cedula='';
    $scope.edad='';
    $scope.descripcion = '';
    $scope.direccion='';
    $scope.comunidad='';
    
   }
   $scope.listarComunidades();
//Function para guardar un registro utlizando promesa
        
        $scope.guardarCliente = () => {
            $scope.verificarCedula('guardar');
            $http.post('/cliente/guardarClientes', {
                nombre: $scope.nombre,
                apellido:$scope.apellido,
                telefono:$scope.telefono,
                tipoDocumento:$scope.tipoDocumento,
                cedula:$scope.cedula,
                edad:$scope.edad,
                descripcion: $scope.descripcion,
                direccion:$scope.direccion,
                comunidad:$scope.comunidad,
                lugarNacimiento:$scope.lugarNacimiento,
                estado: $scope.estado

            }).then(function mySuccess(response) {
                    Swal.fire({
                        //position: 'top-end',
                        type: 'success',
                        title: 'Guardado Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })                  
                    $scope.ocultarFormulario();
                    $scope.listarclientes(1,$scope.buscar);
                
                }, function myError(response) {
                    console.log("error");


                }
            )
        }
        
        //Verficar Cedula
       $scope.verificarCedula=(opcion)=>{
        $http.get('/cliente/listaVerificarCedula') //Esta ruta ya la tengo definida
        .then(function (response) {
            $scope.arregloCedula = response.data;
            var arreglo=$scope.arregloCedula;        
        if(opcion=='guardar'){
            var cedula='cedula';
            for(var i=0;i<arreglo.length;i++){
                 var cedula='cedula';                
                    if(arreglo[i][cedula]==$scope.cedula){
                        alertify.error('ERROR AL GUARDAR: YA EXISTE UNA PERSONA CON ESTE NUMERO DE CEDULA');
                    }
                }
        }  
        if(opcion=='actualizar'){
            var cedula='cedula';
            for(var i=0;i<arreglo.length;i++){
                 var cedula='cedula';                
                    if(arreglo[i][cedula]==$scope.cedula){
                        alertify.error('ERROR AL ACTUALIZAR:  YA EXISTE UNA PERSONA CON ESTE NUMERO DE CEDULA');
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
        $http.put('/comunidad/actualizarcomunidad', {
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
            $scope.listarclientes(1,$scope.buscar);
            

        }, function myError(response) {
            console.log("error", response);

        })
    }
    $scope.desactivarComunidad=(data=[])=>{
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
            $http.put('/comunidad/desactivar', {id: $scope.id  
            }).then(function mySuccess(response) {
                 $scope.listarclientes(1,$scope.buscar);              

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
    $scope.activarComunidad=(data=[])=>{
        Swal.fire({
            title: 'Estas Seguro?',
            text: "Quieres Activar el Registro!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Desactivar!'
          }).then((result) => {
            if (result.value) {
                $scope.id=data['id'];
            $http.put('/comunidad/activar', {id: $scope.id  
            }).then(function mySuccess(response) {
                 $scope.listarclientes(1,$scope.buscar);              

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
        $scope.listarclientes(page,$scope.buscar);
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

    $scope.operacionCedula=()=>{

    }
     $scope.obtenerCedula=()=>{
         $scope.cedula;
          digitosCedula=$scope.cedula;
         elementos=digitosCedula.split('');
             

     }
     $scope.obtenerDigitosCedula=()=>{
         $scope.obtenerCedula();
          arregloObtenido=elementos.slice(4,10);
        
     }
     $scope.converirCedulaANumero=()=>{
         $scope.obtenerDigitosCedula();
         for(i=0;i<arregloObtenido.length; i++){
            convertir=parseInt(arregloObtenido[0] + 
                arregloObtenido[1]+
                arregloObtenido[2]+
                arregloObtenido[3]+
                arregloObtenido[4]+
                arregloObtenido[5] 
                );
         }
         
     }
     $scope.convertirCedulaDeNumeroAFecha=()=>{
         $scope.converirCedulaANumero();
        dia=parseInt(arregloObtenido[0] + arregloObtenido[1]);
        mes=parseInt(arregloObtenido[2] + arregloObtenido[3]);
        anio=parseInt(arregloObtenido[4] + arregloObtenido[5]);
        
     }
     $scope.comprobarSiNacioAntesDelDosMil=()=>{
        $scope.convertirCedulaDeNumeroAFecha();
        if(anio>sigloxx){
            anioNacimiento=1900+anio;
            console.log("Naciste en el siglo XX en el año " + anioNacimiento);
        }
        else{
            anioNacimiento=2000+anio;
            console.log("Nacistes despues del XX en el año " + anioNacimiento);
        }
     }
     $scope.calcularEdad=()=>{ //ME COMPRUEBE EL MES EL DIA PARA CALCULAR LA EDAD
         $scope.comprobarSiNacioAntesDelDosMil();
         if(mes<mesActual || mes==mesActual && dia<diaActual){            
         edad=anioActual-anioNacimiento;
         $scope.edad=edad;
         console.log("tiens " + edad + " años");
         }
         else{
         edad=anioActual-anioNacimiento-1;
         $scope.edad=edad;
         console.log("tiens " + edad + " años");
         }
     }
     $scope.obtenerCodigoMunicipioCedula=()=>{
        $scope.obtenerCedula();
         arregloCodigo=elementos.slice(0,3);
         for(var i=0; i<arregloCodigo.length; i++){
            codigoMunicipio=parseInt(arregloCodigo[0]+ arregloCodigo[1] + arregloCodigo[2]);
         }
       console.log(codigoMunicipio);
    }
    $scope.obtenerCodigoMunicipioCedula();
     $scope.mostrarLugarDeNacimiento=()=>{

     }
}]);