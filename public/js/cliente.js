var myApp = angular.module('myApp', []);

myApp.controller('MyController', ['$scope', '$http', function ($scope, $http) {
    $scope.clienteId=0;
    $scope.nombre = '';
    $scope.apellido='';
    $scope.telefono='';
    $scope.tipoDocumento='CEDULA';
    $scope.cedula='';
    $scope.edad='';
    $scope.descripcion = '';
    $scope.direccion='';
    $scope.comunidad='';
    $scope.lugarNacimiento='';
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
   $scope.mostrarFormulario=(opcion,data=[])=>{
   switch(opcion){
       case 'nuevo':           
    $scope.mostrar=1;
    $scope.nombre = '';
    $scope.apellido='';
    $scope.telefono='';
    $scope.tipoDocumento='CEDULA';
    $scope.cedula='';
    $scope.edad='';
    $scope.descripcion = '';
    $scope.direccion='';
    $scope.comunidad='1';
    $scope.botonGuardar=true;
    $scope.botonActualizar=false;

    break;
        case 'actualizar':                   
    $scope.mostrar=1;
    $scope.clienteId=data['id'];
    $scope.nombre = data['nombre'];
    $scope.apellido=data['apellido'];
    $scope.telefono=data['telefono'];
    $scope.tipoDocumento=data['tipoDocumento'];
    $scope.cedula=data['cedula'];
    $scope.edad=data['edad'];
    $scope.descripcion = data['descripcion'];
    $scope.direccion=data['direccion'];
    $scope.comunidad=data['idcomunidad'].toString();    
    $scope.lugarNacimiento=data['lugarNacimiento'];
    $scope.botonActualizar=true;
    $scope.botonGuardar=false;

    break;
   }
    
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
            if($scope.validarCedula()){
                return;
            }
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
                    }6
                }
        }  
        if(opcion=='actualizar'){
            var cedula='cedula';
            var id='id'
            for(var i=0;i<arreglo.length;i++){
                 var cedula='cedula';                
                    if(arreglo[i][cedula]==$scope.cedula && arreglo[i][id]!=$scope.clienteId){
                        alertify.error('ERROR AL ACTUALIZAR:  YA EXISTE UNA PERSONA CON ESTE NUMERO DE CEDULA');
                    }
                }
        }               
       
        });
       } 
       

//Funtion para actualizar un Registro
    $scope.actualizarCliente = () => {
        $scope.verificarCedula('actualizar');
            if($scope.validarCedula()){
                return;
            }
        $http.put('/cliente/actualizarClientes', {
            id:$scope.clienteId,
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
                //	position: 'top-end',
                type: 'success',
                title: 'Actualizado Exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
            $scope.ocultarFormulario();
            $scope.listarclientes(1,$scope.buscar);
            

        }, function myError(response) {
            console.log("error", response);

        })
    }
    
    $scope.eliminarCliente=(data=[])=>{
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
                $http.post('/cliente/eliminarCliente', 
            {
                id: $scope.id  
            }).then(function mySuccess(response) {
              // console.log(data['id']);
               $scope.listarclientes(1,$scope.buscar);
                          

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
        $scope.calcularEdad();
        $scope.mostrarLugarDeNacimiento();
       
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
            
        }
        else{
            anioNacimiento=2000+anio;
            
        }
     }
     $scope.calcularEdad=()=>{ //ME COMPRUEBE EL MES EL DIA PARA CALCULAR LA EDAD
         $scope.comprobarSiNacioAntesDelDosMil();
         if(mes<mesActual || mes==mesActual && dia<diaActual){  
             if(mes<=12 && dia<=31){                
                 edad=anioActual-anioNacimiento;
                 $scope.edad=edad;
             }
             else{
                 $scope.edad='';
             }   
         }
         else{
            if(mes<=12 && dia<=31){ 
                edad=anioActual-anioNacimiento-1;
                $scope.edad=edad;
            }
            else{
                $scope.edad='';
            }
         }
     }
     $scope.obtenerCodigoMunicipioCedula=()=>{
         arregloCodigo=elementos.slice(0,3);
         for(var i=0; i<arregloCodigo.length; i++){
            codigoMunicipio=parseInt(arregloCodigo[0]+ arregloCodigo[1] + arregloCodigo[2]);
         }
    }

     $scope.mostrarLugarDeNacimiento=()=>{
            $scope.obtenerCodigoMunicipioCedula();
            switch(codigoMunicipio){
                 case 361:
                     $scope.lugarNacimiento='Boaco';                 
                 break;
                case 362:
                    $scope.lugarNacimiento=	'Camoapa';
                break;
                case 363:
                     $scope.lugarNacimiento='Santa Lucía';                 
                 break;
                case 364:
                    $scope.lugarNacimiento=	'San José Del Remate';
                break;
                case 365:
                     $scope.lugarNacimiento='San Lorenzo';                 
                 break;
                case 366:
                    $scope.lugarNacimiento=	'Teustepe';
                break; 
                case 41:
                     $scope.lugarNacimiento='Jinotepe';                 
                 break;               
                case 42:
                     $scope.lugarNacimiento='Diriamba';                 
                 break;
                case 43:
                    $scope.lugarNacimiento=	'San Marcos';
                break;
                case 44:
                     $scope.lugarNacimiento='Santa Teresa';                 
                 break;
                case 45:
                    $scope.lugarNacimiento=	'Dolores';
                break;
                case 46:
                    $scope.lugarNacimiento=	'La Paz Carazo';
                break;
                case 47:
                     $scope.lugarNacimiento='El Rosario';                 
                 break;
                case 48:
                    $scope.lugarNacimiento=	'La Conquista';
                break;
                case 81:
                    $scope.lugarNacimiento=	'Chinandega';
                break;
                case 82:
                    $scope.lugarNacimiento=	'Corinto';
                break;
                case 83:
                    $scope.lugarNacimiento=	'El Realejo';
                break;
                case 84:
                    $scope.lugarNacimiento=	'Chichigalpa';
                break;
                case 85:
                    $scope.lugarNacimiento=	'Posoltega';
                break;
                case 86:
                    $scope.lugarNacimiento=	'El Viejo';
                break;
                case 87:
                    $scope.lugarNacimiento=	'Puerto Morazán';
                break;
                case 88:
                    $scope.lugarNacimiento=	'Somotillo';
                break;
                case 89:
                    $scope.lugarNacimiento=	'Villa Nueva';
                break;
                case 90:
                    $scope.lugarNacimiento=	'Santo Tomás del Norte';
                break;
                case 91:
                    $scope.lugarNacimiento=	'Cinco Pinos';
                break;
                case 92:
                    $scope.lugarNacimiento=	'San Francisco Del Norte';
                break;
                case 93:
                    $scope.lugarNacimiento=	'San Pedro Del Norte';
                break;
                case 121:
                    $scope.lugarNacimiento=	'Juigalpa';
                break;
                case 122:
                    $scope.lugarNacimiento=	'Acoyapa';
                break;
                case 123:
                    $scope.lugarNacimiento=	'Santo Tomás';
                break;
                case 124:
                    $scope.lugarNacimiento=	'Villa Sandino';
                break;
                case 125:
                $scope.lugarNacimiento=	'San Pedro de Lóvago';
                break;
                case 126:
                    $scope.lugarNacimiento=	'La Libertad';
                break;
                case 127:
                        $scope.lugarNacimiento=	'Santo Domingo';
                break;
                case 128:
                        $scope.lugarNacimiento=	'Comalapa';
                break;
                case 129:
                        $scope.lugarNacimiento=	'San Francisco Cuapa';
                break;
                case 130:
                        $scope.lugarNacimiento=	'El Coral';
                break;
                case 161:
                        $scope.lugarNacimiento=	'Estelí';
                break;
                case 162:
                        $scope.lugarNacimiento=	'Pueblo Nuevo';
                break;
                case 163:
                        $scope.lugarNacimiento=	'Condega';
                break;
                case 164:
                        $scope.lugarNacimiento=	'San Juan Limay';
                break;
                case 165:
                        $scope.lugarNacimiento=	'La Trinidad';
                break;
                case 166:
                        $scope.lugarNacimiento=	'San Nicolás';
                break;
                case 201:
                        $scope.lugarNacimiento=	'Granada';
                break;
                case 202:
                        $scope.lugarNacimiento=	'Nandaime';
                break;
                case 203:
                        $scope.lugarNacimiento=	'Diriomo';
                break;
                case 204:
                        $scope.lugarNacimiento=	'Diriá';
                break;
                case 241:
                        $scope.lugarNacimiento=	'Jinotega';
                break;
                case 242:
                        $scope.lugarNacimiento=	'San Rafael Del Norte';
                break;
                case 243:
                        $scope.lugarNacimiento=	'San Sebastián Yalí';
                break;
                case 244:
                        $scope.lugarNacimiento=	'La Concordia';
                break;
                case 245:
                        $scope.lugarNacimiento=	'San José De Bocay';
                break;
                case 246:
                        $scope.lugarNacimiento=	'El Cuá Bocay';
                break;
                case 247:
                        $scope.lugarNacimiento=	'Santa María Pantasma';
                break;
                case 281:
                        $scope.lugarNacimiento=	'León';
                break;
                case 283:
                        $scope.lugarNacimiento=	'El Jicaral';
                break;
                case 284:
                        $scope.lugarNacimiento=	'La Paz Centro';
                break;
                case 285:
                        $scope.lugarNacimiento=	'Santa Rosa Del Peñón';
                break;
                case 286:
                        $scope.lugarNacimiento=	'Quetzalguaque';
                break;
                case 287:
                        $scope.lugarNacimiento=	'Nagarote';
                break;
                case 288:
                        $scope.lugarNacimiento=	'El Sauce';
                break;
                case 289:
                        $scope.lugarNacimiento=	'Achuapa';
                break;
                case 290:
                        $scope.lugarNacimiento=	'Telica';
                break;
                case 291:
                        $scope.lugarNacimiento=	'Larreynaga Malpaisillo';
                break;
                
                default:
                    $scope.lugarNacimiento="CODIGO NO REGISTRADO"; 
                }
     }  
     $scope.validarCedula=()=>{
         $scope.obtenerCedula();
        let error;             
        if(dia>=31|| mes>12 || digitosCedula.length<16){
         error=  alertify.error('Cedula esta Vacia o Esta mal escrita');                 
     } 
         return error;
     }
     
}]);