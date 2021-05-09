<template>
  <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4"  v-for="people in peoples" :key="people.id">
                    <div class="card">
                        <img class="card-img-bottom" v-bind:src="'storage/' + people.image" alt="Card image"/>
                        <div class="card-body">
                            <h4 class="card-title">{{ people.email }}</h4>
                            <p class="card-text">
                                Some example text some example text. Jane Doe is an architect and
                                engineer
                            </p>
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
                                            <a type="button" class="btn btn-primary"><i class="fas fa-trash-alt"></i></a>
                                            <a type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
    <!-- <h3 class="text-center">All Posts</h3><br/>
 
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="people in peoples" :key="people.id">
                <td>{{ people.id }}</td>
                <td>{{ people.name }}</td>
                <td>{{ people.email }}</td>
                <td>{{ people.password }}</td>
                <td>{{ people.fone}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: people.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deletePost(people.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table> -->
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
    deletePost(id) {
      this.axios
        .delete(`http://localhost:8000/api/post/delete/${id}`)
        .then((response) => {
          let i = this.people.map((item) => item.id).indexOf(id); // find index of your object
          this.posts.splice(i, 1);
        });
    },
    loadPeoples: function () {
      axios
        .get("api/peoples")
        .then((response) => {
          this.peoples = response.data.data;
        })
        .catch((error) => alert(error.message));
    },
  },
};
</script>