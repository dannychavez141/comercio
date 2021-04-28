var mod = new Vue(
        {el: "#registro",
            data: {
                urlBase: "http://intranet.premiumcollege.edu.pe/",
                compromiso: [],
                detalles: [],
                tipo: 1,
                est: 1,
                idCompromiso: 0
            },
            methods: {
                async consulta() {
                    const Api = this.urlBase + "ajax/apiCompromiso.php?ac=uno&id=" + calcMD5(this.idCompromiso);
                    console.log(Api);
                    try {
                        const response = await axios.get(Api);
                        mod.detalles = response.data;
                        console.log(mod.detalles);
                        mod.compromiso['idalu'] = mod.detalles[0][8];
                        mod.compromiso['alumno'] = (mod.detalles[0][26] + " " + mod.detalles[0][27] + " " + mod.detalles[0][28]);
                        mod.compromiso['idapo'] = mod.detalles[0][9];
                        mod.compromiso['apo'] = (mod.detalles[0][16] + " " + mod.detalles[0][17] + " " + mod.detalles[0][18]);
                        mod.compromiso['descr'] = mod.detalles[0][10];
                        mod.compromiso['fecha'] = mod.detalles[0][11];
                        mod.compromiso['monto'] = mod.detalles[0][12];
                        mod.compromiso['est'] = mod.detalles[0][13];
                        //console.log(mod.compromiso);
                    } catch (error) {
                        console.error(error);
                    }
                }, confPagar(id) {
                    bootbox.confirm({
                        message: "La cuota del compromiso de pago cambiara de estado a pagado, desea Proceder?",
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
                                console.log("gowi" + id);
                                mod.pagar(id);
                                mod.consulta();
                            } else {
                                console.log("no gowi");
                            }

                        }
                    });
                }, async pagar(id) {
                    const  url = this.urlBase + "ajax/apiCompromiso.php";
                    const params = new URLSearchParams();
                    params.append('ac', 'md');
                    params.append('id', id);
                    params.append('tip', 2);
                    try {
                        const resp = await  axios.post(url, params);
                        this.mensaje(resp.data);

                    } catch (e) {
                        console.log(log);
                    }

                }, async anular(id) {
                    const  url = this.urlBase + "ajax/apiCompromiso.php";
                    const params = new URLSearchParams();
                    params.append('ac', 'md');
                    params.append('id', id);
                    params.append('tip', 1);
                    try {
                        const resp = await  axios.post(url, params);
                        this.mensaje(resp.data);
                    } catch (e) {
                        console.log(log);
                    }

                }, confAnular(id) {
                    bootbox.confirm({
                        message: "La cuota del compromiso de pago cambiara de estado a Pendiente, desea Proceder?",
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
                                console.log("gowi" + id);
                                mod.anular(id);
                                mod.consulta();
                            } else {
                                console.log("no gowi");
                            }

                        }
                    });
                }, confMCompromiso() {
                    bootbox.confirm({
                        message: "La cuota del compromiso de pago cambiara de estado a pagado, desea Proceder?",
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
                                mod.modificar();
                                mod.consulta();
                            } else {
                                console.log("no gowi");
                            }

                        }
                    });
                }, async modificar() {
                    const  url = this.urlBase + "ajax/apiCompromiso.php";
                    const params = new URLSearchParams();
                    params.append('ac', 'mc');
                    params.append('id', this.idCompromiso);
                    params.append('descr', this.compromiso['descr']);
                    params.append('est', this.compromiso['est']);
                    try {
                        const resp = await  axios.post(url, params);
                        this.mensaje(resp.data);

                    } catch (e) {
                        console.log(log);
                    }

                }, mensaje(msj) {
                    bootbox.alert(msj);
                }
            },
            mounted() {
                const valores = window.location.search;
//Mostramos los valores en consola:
                console.log(valores);
                const urlParams = new URLSearchParams(valores);
//Accedemos a los valores
                this.idCompromiso = urlParams.get('id');
                this.consulta();
            }

        });
