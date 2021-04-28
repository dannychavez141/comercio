var app = new Vue({
  el: "#registro",
  data: {
    consulta: "", 
    
  },
  methods: {
    //consultas
    consulta() {
      const url = "./";
      const params = new URLSearchParams();
      params.append("query", this.consulta);
      return axios
        .post(url, params)
        .then(function (response) {
          //console.log(response.data);
          app.respuesta = response.data;
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      //consultar inicio
    },
    async llamarMaderas() {
      this.consulta = "tipos('" + this.tipos["lastLine"] + "').";
      console.log(this.consulta);
      this.maderas = await this.consultapl();
      
      if(this.consulta=="tipos('')."){
        this.encontrados=0;
      }else{this.encontrados=1;}
      console.log(this.encontrados);
    },
  
  },
  mounted: function () {
      
  },
});


