var registro = new Vue({
    el: '#registro',
    data: {
        urlBase: "http://intranet.premiumcollege.edu.pe/",
        busqAlu: "",
        busqApo: "",
        urlAlu: "ajax/cAlumnos.php",
        urlApo: "ajax/apiApoderado.php",
        alumno: [],
        padre: [],
        alumnos: [],
        padres: [],
        detallesCom: [],
        detalle: [],
        compromiso: [],
        vista: 0,
        fCrea: "",
        fVenc: "",
        cont: 0,
        est: 1



    },
    methods: {
        async  consultaAlumnos() {
            const Api = this.urlBase + this.urlAlu + "?control=all&bus=" + this.busqAlu;
            try {
                const response = await axios.get(Api);
                registro.alumnos = response.data;
                console.log(registro.alumnos);
            } catch (error) {
                console.error(error);
            }
        },
        async  consultaApoderados() {
            const Api = this.urlBase + this.urlApo + "?control=all&bus=" + this.busqApo;
            try {
                const response = await axios.get(Api);
                //  console.log(response);
                registro.padres = response.data;
                console.log(registro.padres);
            } catch (error) {
                console.error(error);
            }
        },
        elegirAlu(datos) {
            this.alumno = datos;
            console.log(this.alumno);
        },
        elegirApo(datos) {
            this.padre = datos;
            console.log(this.padre);
        }, añadirDetalle() {
            this.detalle['fvenci'] = this.fVenc;
            var montot = Number(this.detalle['monto']);
            if (montot > 0) {
                this.compromiso['monto'] += montot;
                this.detallesCom.push({
                    descrDet: this.detalle['descrDet'],
                    fvenci: this.detalle['fvenci'],
                    canti: this.detalle['canti'],
                    monto: montot
                });
                this.detalle['descrDet'] = "";
                this.detalle['fvenci'] = "";
                this.detalle['canti'] = 1;
                this.detalle['monto'] = 0.00;
                console.log(this.detallesCom);
            } else {
                this.mensaje("El monto no puede ser igual o inferior a 0");
            }


        }, quitarDetalle(id) {
            this.compromiso['monto'] -= Number(this.detallesCom[id]['monto']);
            this.detallesCom.splice(id, 1);
            //console.log(this.detalle);
            console.log(this.detallesCom);
        }, async  registrar() {
            var det = this.detallesCom.length;
            if (det > 0) {
                bootbox.confirm({
                    message: "Usted termino de configurar el compromiso de pago? Al marcar si se procedera a registrar.",
                    buttons: {
                        confirm: {
                            label: 'Si',
                            className: 'btn btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn btn-danger'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            console.log("gowi");
                            registro.registrarApi();
                        } else {
                            console.log("no gowi");
                        }

                    }
                });
            } else {
                bootbox.alert("No se agregaron detalles de compromiso de pago");
            }
        }, async registrarApi() {
            const  url = this.urlBase + "ajax/apiCompromiso.php";
            const params = new URLSearchParams();
            params.append('ac', 'r');
            params.append('idAlumno', this.alumno['idAlumnos']);
            params.append('idApoderado', this.padre['idApoderado']);
            params.append('descrComp', this.compromiso['descr']);
            params.append('creacion', this.fCrea);
            params.append('monto', this.compromiso['monto']);
            params.append('est', this.est);
            params.append('detalles', JSON.stringify(this.detallesCom));
            const resp = await  axios.post(url, params);
            // console.log(resp);
            // this.mensaje(resp.data)
            bootbox.confirm({
                message: resp.data,
                buttons: {
                    confirm: {
                        label: 'Ver Compromisos',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        label: 'Nuevo Compromiso',
                        className: 'btn btn-danger'
                    }
                },
                callback: function(result) {
                    if (result) {
                        console.log("gowi");
                        window.location.href = "./compromisos.php";
                    } else {
                        console.log("no gowi");
                        window.location.href = "./compromisos.php?vista=reg";
                    }

                }
            });
        }, mensaje(msj) {
            bootbox.alert(msj);
        }
    },
    mounted() {
        this.compromiso['monto'] = 0.00;
        this.consultaAlumnos();
        this.consultaApoderados();
        let f = new Date();
        this.fCrea = f.getFullYear() + "-" + (f.getMonth() + 1).toString().padStart(2, '0') + "-" + f.getDate().toString().padStart(2, '0');
        this.fVenc = this.fCrea;
        this.compromiso['fecha'] = this.fCrea;
        console.log(this.fCrea);
        this.detalle['canti'] = 1;
        this.detalle['monto'] = 0.00;
    }
});