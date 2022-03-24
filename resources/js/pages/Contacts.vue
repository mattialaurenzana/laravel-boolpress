<template>
  <div>
      <h1 class="text-center m-3" v-if="!formSubmitted">contatti</h1>
      <div class="container" v-if="!formSubmitted">
          
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Inserire il nome" v-model="formData.name">
            </div>
            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input type="text" name="surname" class="form-control" placeholder="inserire il cognome" v-model="formData.surname">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" v-model="formData.email">

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert" v-if="formValidationErrors && formValidationErrors.email">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                       {{formValidationErrors.email[0]}}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Messaggio</label>
                <textarea name="message" class="form-control" v-model="formData.message"></textarea>

                 <div class="alert alert-danger d-flex align-items-center" role="alert" v-if="formValidationErrors && formValidationErrors.message">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                       {{formValidationErrors.message[0]}}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" @click="formSubmit()">Invia</button>  
            </div>
        
      </div>
      <div v-else class="alert alert-success py-3 success">
          <h4>Grazie per averci contattato</h4>
          <p class="lead">La sua richiesta è stata inviata correttamente.</p>
      </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{

            formSubmitted: false,
            formValidationErrors: null,
            formData: {
                name: "",
                surname: "",
                email: "",
                message: "",
            }
        }
    },
   methods: {
            async formSubmit(){
                try{
                    this.formValidationErrors = null; //resetto la variabile quando il submit va a buon fine
                    const resp = await axios.post('/api/contacts', this.formData);
                    this.formSubmitted = true;
                }catch(er){
                    if(er.response.status === 422){  //verifico che l'errore sia di validazione
                    this.formValidationErrors = er.response.data.errors;  //salvo nella mia variabile locale gli errori di validazione ritornati dal server

                    }
                }
               
            }
        }  
}     
</script>

<style lang="scss" scoped>
    .container{
        width: 50%;
    }

    .success{
        width: 60%;
        margin: 100px auto;
        padding: 5px;
    }

    .alert{
        padding: 3px;
    }
</style>