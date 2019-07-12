<template>
    <div class="modal fade" id="consultation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Consulta de Estudiantes</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-md-12 p-2">
                            <div class="form-group">
                                <label><strong>Buscar <i class="fas fa-search"></i></strong></label>
                                <v-select :filterable="false" :options="students" @search="onSearch" v-model="student">
                                    <template slot="no-options">
                                        No se Encontraron Datos
                                    </template>
                                    <template slot="option" slot-scope="option">
                                        <div class="d-center">
                                            <span :class="option.country.flag"></span> <strong>{{ option.name }} {{ option.lastname }}</strong> <small>{{ option.email }}</small> <small><strong>{{ option.state=='1'?'Estudiante':'Interesado' }}</strong></small>
                                        </div>                         
                                    </template>
                                    <template slot="selected-option" slot-scope="name">
                                        <div class="selected d-center">                                            
                                            <span :class="name.country.flag"></span> <strong v-text="`${name.name} ${name.lastname}`"></strong> <small v-text="name.email" class="text-muted"></small>                                  
                                        </div>
                                    </template>
                                </v-select>                              
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12" v-show="student!=null">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informacion</a>
                                    <a class="nav-item nav-link" :class="student==null?'disabled':''" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Nueva Consulta</a>                                    
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-md-5 p-2" v-show="sales.length > 0">
                                            <div class="card border-dark">
                                                <div class="card-header bg-dark text-white text-center">
                                                    <h4>Ventas</h4>
                                                </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table table-bordered text-center table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Codigo</th>
                                                                <th>Fecha</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="sale in sales" :key="sale.id">
                                                                <td><a :href="Url + 'sales/' + sale.id" target="_blank">{{ sale.code }}</a></td>
                                                                <td>{{ sale.date }}</td>
                                                                <td>{{ sale.total }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 p-2" v-show="assignments.length > 0">
                                            <div class="card border-primary">
                                                <div class="card-header bg-primary text-white text-center">
                                                    <h4>Cursos</h4>
                                                </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table table-bordered text-center table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Código</th>
                                                                <th>Curso</th>                                          
                                                                <th>Estado</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="assignment in assignments" :key="assignment.id">
                                                                <td><a :href="Url + 'assignments/' + assignment.code" target="_blank">{{ assignment.code }}</a></td>                                                
                                                                <td><span><img :src="assignment.course.image_url" width="35px"> {{ assignment.course.name}}</span></td>
                                                                <td>{{ assignment.finished==0?'No Terminado':'Curso Terminado' }}</td>
                                                                <td>{{ assignment.start_date }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2" v-show="consultations.length > 0">
                                            <div class="card border-success">
                                                <div class="card-header bg-success text-white text-center">
                                                    <h4>Consultas</h4>
                                                </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table table-bordered text-center table-sm">
                                                        <thead>
                                                            <tr>                 
                                                                <th>Usuario</th>       
                                                                <th>Contacto</th>  
                                                                <th>Interés</th>
                                                                <th>Curso</th>                                                            
                                                                <th>Desscripción</th>
                                                                <th>Notificó</th>
                                                                <th>Finalizado</th>
                                                                <th>Fecha</th>
                                                                <th>Preguntas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="consultation in consultations" :key="consultation.id">
                                                                <td>{{ consultation.user.name }}</td>
                                                                <td>{{ consultation.contact.description }} <i :class="consultation.contact.icon"></i></td>         
                                                                <td><span :style="`color:${consultation.interest.colour}`" v-text="consultation.interest.name"></span> <span v-html="consultation.interest.stars"></span></td>
                                                                <td><span><img :src="consultation.course.image_url" width="35px"> {{ consultation.course.name}}</span></td>                                                           
                                                                <td><a :href="Url + 'consultations/' + consultation.id" target="_blank">{{ consultation.description }}</a></td>                                                                
                                                                <td>{{ consultation.notification==1?'SI':'NO' }}</td>
                                                                <td>{{ consultation.finished==1?'SI':'NO' }}</td>
                                                                <td>{{ consultation.date }}</td>
                                                                <td>{{ consultation.details_count }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label><strong>Contacto</strong></label>
                                                            <select class="selectpicker form-control" data-size="5" data-style="border-dark" data-live-search="true" title="Contacto" v-model="contact" ref="contact">
                                                                <option v-for="contact in contacts" :key="contact.id" :value="contact" :data-icon="`${contact.icon}`">{{ contact.description }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label><strong>Curso Interesado</strong></label>
                                                            <select class="selectpicker form-control" data-size="3" data-style="border-dark" data-live-search="true" title="Buscar Curso" v-model="course" ref="course">
                                                                <option v-for="course in courses" :key="course.id" :value="course" :data-content="`<img src='${course.image_url}' width='30px'> <strong>${course.name}</strong> <small class='text-muted'>Codigó: ${course.code}</small>`"></option>
                                                            </select>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label><strong>Nivel de Interés</strong></label>
                                                            <select class="selectpicker form-control" data-size="5" data-style="border-dark" data-live-search="true" title="Buscar Curso" v-model="interest" ref="interest">
                                                                <option v-for="interest in interests" :key="interest.id" :value="interest" :data-content="`<strong style='color: ${interest.colour}'>${interest.name}</strong>`"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                         <div class="form-group">
                                                            <label><strong>Recordatorio</strong></label>
                                                            <input type="date" class="form-control border-dark text-center" v-model="reminder_date">                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><strong>Descripción</strong></label>
                                                            <textarea class="form-control border-dark" rows="4" v-model="description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" v-show="student!=null">
                                                        <div class="form-group">                                                            
                                                            <button class="btn btn-block btn-lg btn-primary" @click="SaveConsultation">Registrar Consulta</button>
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import toastr from 'toastr'

    export default {
        created() {
            this.Url = this.$appUrl
            this.GetData()
        },
        data() {
            return {
                Url: '',
                veri: 0, 
                
                students: [],
                student: null,

                sales: [],
                assignments: [],
                consultations: [],

                contacts: [],
                courses: [],
                interests: [],

                contact: {},
                course: {},
                interest: {},
                reminder_date: '',
                description: '',
            }
        },
        methods: {
            GetData() {
                axios.get(`${this.Url}consultation-data`)
                .then(response => {                     
                    this.contacts = response.data.contacts
                    this.courses = response.data.courses
                    this.interests = response.data.interests
                }).catch(error => {
                    toastr.error(error)
                });
            },
            SearchInformation(id) {
                axios.get(`${this.Url}get_information_student/${id}`)
                .then(response => {                     
                    this.sales = response.data.sales
                    this.assignments = response.data.assignments
                    this.consultations = response.data.consultations
                }).catch(error => {
                    toastr.error(error)
                });
            },
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
                this.students = [];
                if (this.student!=null)
                {              
                    this.SearchInformation(this.student.id)
                }
            },
            search: _.debounce((loading, search, vm) => {
                fetch(`${vm.Url}consultation-students?name=${escape(search)}`).then(res => {
                    if(res!=null) {
                         res.json().then(json => {
                            vm.students = json
                        });
                    }
                    loading(false);
                });
            }),
            SaveConsultation () {

                for(var index in this.student.consultations){
                    if(this.course.id==this.student.consultations[index].course_id){
                        toastr.warning('Este Curso ya Fue Consultado')
                        this.course = {};
                        this.veri++;
                    }                    
                }

                if (this.veri==0) {
                    if((this.student!=null) && (Object.keys(this.contact).length > 1) && (Object.keys(this.course).length > 1) && (Object.keys(this.interest).length > 1) && (this.reminder_date!='') && (this.description!='')) {
                        axios.post(`${this.Url}consultations`, {
                            student_id : this.student.id,
                            contact_id : this.contact.id,
                            course_id : this.course.id,
                            interest_id : this.interest.id,
                            reminder_date : this.reminder_date,
                            description : this.description                        
                        }).then(response => {
                            $('#consultation-modal').modal('hide');
                            toastr.success('Consulta Registrada');
                            setTimeout(() => {
                                    window.location.href = response.data;                            
                            },1000);
                        }).catch(error => {
                            toastr.error(error);
                        })
                    } else {
                        toastr.error('Complete los datos de la Consulta');
                    }
                }
                else {
                    this.veri=0
                }
            }
        },
        updated() {
            $('.selectpicker').selectpicker('refresh');           
        }
    }
</script>