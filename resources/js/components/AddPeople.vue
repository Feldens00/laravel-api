<template>
    <div>
        <h3 class="text-center">Adicionar Pessoa</h3>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="addPeople">
                    <div class="form-row">
                        <div class="col-md-6 col-12">
                            <label>Nome</label>
                            <input type="text" class="form-control" v-model="people.name">
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="people.email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 col-12">
                            <label>Senha</label>
                            <input type="text" class="form-control" v-model="people.password">
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Telefone</label>
                            <input type="tel" class="form-control" v-model="people.fone">
                        </div>
                    </div>
                   
                    <div class="form-row mt-4">
                        <label>Telefone</label>
                        <input type="file" accept="image/jpeg, image/png" class="form-control" @change="handleOnChange">
                    </div>
                    <div class="form-row mt-4">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                people: {}
            }
        },
        methods: {
            handleOnChange(e){

                this.people.image = e.target.files[0];
            },
            addPeople() {
                const data = new FormData();
                data.append('name', this.people.name);
                data.append('email', this.people.email);
                data.append('password', this.people.password);
                data.append('fone', this.people.fone);
                data.append('image', this.people.image);
                axios({
                        method: 'post',
                        url: '../api/people/',
                        data: data,
                        headers: { 'Content-Type': 'multipart/form-data' },
                    })
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    })
                    .catch((error) =>{
                        if(error. response){
                            console.log(error. response. data)
                            console.log(error. response. status);
                        }
                    });
            }
        }
    }
</script>