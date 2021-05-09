<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4"  v-for="people in peoples" :key="people.id">
                        <div class="card">
                            <img class="card-img-top" v-bind:src="'storage/' + people.image" alt="Card image"/>
                            <div class="card-body">
                                <h4 class="card-title">{{ people.name }}</h4>
                                <div class="row mb-2">
                                    <div class="col-lg-12 col-md-12">
                                        <p class="card-text">Email: <small class="text-muted">{{ people.email }}</small></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <p class="card-text">Senha: <small class="text-muted">{{ people.password }}</small></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-6">
                                            <div class="btn-group">
                                                <router-link :to="{name: 'edit', params: { id: people.id }}" class="btn btn-primary"><i class="fas fa-pen"></i></router-link>
                                                <a type="button" class="btn btn-danger" v-on:click="deletePeople(people.id)"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-6">
                                            <p class="card-text"><small class="text-muted"><i class="fas fa-phone"></i> {{ people.fone }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
  data() {
    return {
      peoples: [],
    };
  },
  mounted() {
    this.loadPeoples();
  },
  methods: {
    deletePeople(id) {
        axios
        .delete(`api/people/${id}`)
        .then((response) => {
          let i = this.peoples.map(data => data.id).indexOf(id);
                        this.peoples.splice(i, 1)
        })
        .catch((error) =>{
            if(error. response){
                console.log(error. response. data)
                console.log(error. response. status);
            }
        });
    },
    loadPeoples: function () {
      axios
        .get('api/peoples')
        .then((response) => {
          this.peoples = response.data.data;
        })
        .catch((error) =>{
            if(error. response){
                console.log(error. response. data)
                console.log(error. response. status);
            }
        });
    },
  },
};
</script>