<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="openModalWindow">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
             
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Modify</th>
                  </tr> 

                  <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.first_name | strToUpper }}</td>
                    <td>{{ user.last_name }}</td>
                    <td>{{ user.phone}}</td>
                    <td>{{ user.email}}</td>
                    <td><img :src="`img/profile/${user.avatar}`" class="profile-user-img img-fluid img-circle" style="height:40px; width:40px;"></td>

                    <td>
                        <a href="#" data-id="user.id" @click="editModalWindow(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        |
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                </tbody></table>
              </div>
            
              <div class="card-footer">
                 
              </div>
            </div>
           
          </div>
        </div>


            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">

                    <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New User</h5>
                    <h5 v-show="editMode" class="modal-title" id="addNewLabel">Update User</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>

<form @submit.prevent="editMode ? updateUser() : createUser()" enctype="multipart/form-data">
<div class="modal-body">
    <div class="form-group">
        <input v-model="form.first_name" type="text" name="first_name"
            placeholder="Enter First Name"
            class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
        <div v-if="form.errors.has('first_name')" v-html="form.errors.get('first_name')" />
    </div>

    <div class="form-group">
        <input v-model="form.last_name" type="text" name="last_name"
            placeholder="Enter Last Name"
            class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
        <div v-if="form.errors.has('last_name')" v-html="form.errors.get('last_name')" />
    </div>

    <div class="form-group">
        <input v-model="form.email" type="email" name="last_email"
            placeholder="Enter Email"
            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
        <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
    </div>

    <div class="form-group">
        <input v-model="form.phone" type="text" name="phone"
            placeholder="Enter Phone"
            class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
        <div v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" />
    </div>

    <div class="form-group" v-show="!editMode">
        <input v-model="form.password" type="password" name="password" id="password" placeholder="Enter Password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
        <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
    </div>

    <!--<div class="form-group" v-show="!editMode">
        <input v-model="form.confirm_password" type="password" name="password_confirmation" id="password" placeholder="Enter Confirm Password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
        <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
    </div> -->

    <div class="form-group">
        <select name="role" v-model="form.role" id="role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
            <option value="0">Select User Role</option>
            <option value="admin">Admin</option>
            <option value="educator">Educator</option>
            <option value="student">Student</option>
        </select>
        <div v-if="form.errors.has('role')" v-html="form.errors.get('role')" />
    </div>

    <div class="form-group">
        <input type="file" name="avatar" id="avatar" 
        class="form-control" :class="{ 'is-invalid': form.errors.has('avatar') }" v-on:change="onChange">
        <img class="profile-user-img img-fluid img-circle" :src="getPhoto()" alt="User profile picture">
       <!-- <has-error :form="form" field="avatar"></has-error> -->
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
    <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
</div>

</form>

                </div>
            </div>
            </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                users: {},
                form: new Form({
                    id: '',
                    first_name : '',
                    last_name : '',
                    email: '',
                    phone: '',
                    password: '',
                   // password_confirmation: '',
                    role: '',
                    avatar: null,

                })
            }
        },
        methods: {
        onChange(e) {
               // this.avatar = e.target.files[0];
               // console.log(this.avatar);
                let file = e.target.files[0];
                let reader = new FileReader();  

                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                     this.form.avatar = reader.result;
                    }              
                     reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
            },
            //For getting Instant Uploaded Photo
            getPhoto(){
                let photo = this.form.avatar;
              // let photo = (this.form.avatar.length > 100) ? this.form.avatar : "img/profile/"+ this.form.avatar;
                return photo;
            },
        editModalWindow(user){
           this.form.clear();
           this.editMode = true
           this.form.reset();
           $('#addNew').modal('show');
           this.form.fill(user)
        },
        updateUser(){
           this.form.put('/api/admin/user/update/'+this.form.id)
               .then(()=>{

                   Toast.fire({
                      icon: 'success',
                      title: 'User updated successfully'
                    })

                    Fire.$emit('AfterCreatedUserLoadIt');

                    $('#addNew').modal('hide');
               })
               .catch(()=>{
                  console.log("Error.....")
               })
        },
        openModalWindow(){
           this.editMode = false
           this.form.reset();
           $('#addNew').modal('show');
        },

        loadUsers() {

        axios.get("/api/admin/user/index").then( data => (this.users = data.data));

          //pick data from controller and push it into users object

        },

        createUser(){
            
            this.$Progress.start()
            
            this.form.post('/api/admin/user/store')
                .then(() => {
                  
                    Fire.$emit('AfterCreatedUserLoadIt'); //custom events
                        Toast.fire({
                          icon: 'success',
                          title: 'User created successfully'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');

                })
                .catch(() => {
                   console.log("Error......")
                })

     

            //this.loadUsers();
          },
          deleteUser(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                
              if (result.value) {
                //Send Request to server
                this.form.delete('/api/admin/user/destroy/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'User deleted successfully',
                              'success'
                            )
                    this.loadUsers();

                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        })
                    })
                }

            })
          }
        },

        created() { 
            this.loadUsers();

            Fire.$on('AfterCreatedUserLoadIt',()=>{ //custom events fire on
                this.loadUsers();
            });

        }
    }
</script> 