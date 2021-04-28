var visual = new Vue(
        {el: '#registro',
            data: {
                urlBase: "http://intranet.premiumcollege.edu.pe/",
                compromisos: [],
                busqu: "",
                tipo: 1,
                est: 1
            },
            methods: {
                async consulta() {
                    const Api = this.urlBase + "ajax/apiCompromiso.php?ac=all&variable=" + this.busqu + "&filtro=" + this.tipo + "&estado=" + this.est;
                    try {
                        const response = await axios.get(Api);
                        visual.compromisos = response.data;
                        console.log(visual.compromisos);
                    } catch (error) {
                        console.error(error);
                    }
                }, popUp(id) {
                    var hash = calcMD5(id);
                    let url = this.urlBase + "pdfCompromiso.php?id=" + hash;
                    window.open(url, 'V', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=1200,left = 700,top = 50');
                }
            },
            mounted() {
                this.consulta();
            }

        });
