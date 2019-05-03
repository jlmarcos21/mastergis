<template>    
    <div class="row">
        <div class="col-md-12" v-show="spinner==false">
            <div class="card">
                <div class="card-header"><h3>Realizar Ventas de Cursos</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estudiante</label>
                                <select class="selectpicker form-control" data-size="5" data-style="border border-dark" data-live-search="true" title="Buscar Estudiante" v-model="student" ref="student" @change="studentChange()">
                                    <option v-for="student in students" :key="student.id" :value="student" :data-content="`${student.lastname} ${student.name} <small class='text-muted'>Codigó: ${student.code}</small>`"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Metodo de Pago</label>
                                <select class="selectpicker form-control" data-size="5" data-style="border border-dark" data-live-search="true" title="Metodo de Pago" v-model="payment" ref="payment">
                                    <option v-for="payment in payments" :key="payment.id" :value="payment" :data-icon="`${payment.icon} text-success`">{{ payment.name }} </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Descripcion de Pago</label>
                                <input type="text" class="form-control border border-dark" v-model="description" ref="description">
                            </div>
                        </div>
                        <div class="col-md-2" v-if="payment.id==2 || payment.id==3 || payment.id==4">
                            <div class="form-group">
                                <label>Credito (Opcional)</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="chekcredit" v-model="credit">
                                    <label class="custom-control-label" for="chekcredit"><strong>Credito</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Moneda</label>
                                <select class="selectpicker form-control" data-size="5" data-style="border border-dark" data-live-search="true" title="Moneda" v-model="currency" ref="currency">
                                    <option v-for="currency in currencies" :key="currency.id" :value="currency" :data-icon="`${currency.flag}`"> {{ currency.icon }} {{ currency.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-dark">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Seleccionar Curso</label>
                                <select class="selectpicker form-control" data-size="5" data-style="border border-dark" data-live-search="true" title="Buscar Curso" v-model="course" ref="course" @change="$refs.price.focus()">
                                    <option v-for="course in courses" :key="course.id" :value="course" :data-content="`<img src='${course.image_url}' width='30px'> <strong>${course.name}</strong> <small class='text-muted'>Codigó: ${course.code}</small>`"></option>
                                </select>
                            </div>
                        </div>                            
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Precio del Curso</label>
                                <input type="number" class="form-control border border-dark text-center" v-model="price" ref="price" @keypress.enter="AddCourses()">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Añadir</label>
                                <button class="btn btn-block btn-primary" @click="AddCourses()"><i class="fas fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10px"><i class="far fa-trash-alt"></i></th>
                                            <th>Descripcion del Curso</th>
                                            <th width="10%" class="text-center">Precio</th>
                                            <th width="10px">Cantidad</th>
                                            <th width="10%" class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(details, index)  in CoursesDatails" :key="details.course_id">
                                            <td>
                                                <button class="btn btn-sm btn-danger" @click="DeleteCourse(index)"><i class="far fa-trash-alt"></i></button>
                                            </td>
                                            <td>
                                                {{ details.course_description }}
                                            </td>
                                            <td class="text-center">
                                                {{ currency.icon }} {{ details.course_price }}
                                            </td>
                                            <td class="text-center">
                                                {{ details.course_quantity }}
                                            </td>
                                            <td class="text-center">
                                                {{ currency.icon }} {{ details.course_total }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><strong>Subtotal:</strong></td>
                                            <td class="text-center">{{ currency.icon }} {{ subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><strong>Total:</strong></td>
                                            <td class="text-center">{{ currency.icon }} {{ total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12" v-show="CoursesDatails.length > 0">
                            <button class="btn btn-block btn-lg btn-success" @click="SaveSale()">Registrar Venta</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center" v-show="spinner==true">
            <img src="https://loading.io/spinners/coin/index.money-coin-palette-color-preloader.svg" alt="Cargando..." width="50%">
        </div>
    </div>    
</template>

<script>
    import toastr from 'toastr'

    export default {        
        created() {
            this.Url = this.$appUrl
            this.GetData()
            this.Calculate()            
        },
        data() {
            return {
                Url: '',
                count: 0,
                veri: 0,

                spinner : false,

                students: [],
                payments: [],
                currencies: [],
                courses: [],

                description: '',
                credit: false,
                student: {},
                payment: {},
                currency: {},
                course: {},
                price: '0.0',

                subtotal: 0,
                total: 0,

                CoursesDatails: [],
                
            }
        },
        methods: {
            GetData() {
                axios.get(`${this.Url}api/get-data-sale`)
                .then(response => {
                     this.students = response.data.students
                     this.payments = response.data.paymentms
                     this.currencies = response.data.currencies
                     this.courses = response.data.courses
                }).catch(error => {
                    toastr.error(error)
                });
            },
            AddCourses() {
                if(Object.keys(this.student).length != 0){
                                
                    for(var index in this.student.assignments){
                        if(this.course.id==this.student.assignments[index].course_id){
                            toastr.warning('Este Curso ya fue Comprado por el Estudiante')
                            this.ClearCourse()
                            this.veri++
                        }                    
                    }

                    if(this.veri==0){
                        for(var index in this.CoursesDatails){
                            if(this.course.id==this.CoursesDatails[index].course_id){
                                toastr.error('El Curso ya esta en la Lista')
                                this.$refs.course.focus()
                                this.ClearCourse()
                                this.count++
                            }                    
                        }

                        if(this.count==0){
                            if(Object.keys(this.course).length != 0 && this.price != ""){
                                this.CoursesDatails.unshift({
                                    course_id : this.course.id,
                                    course_code : this.course.code,
                                    course_description : this.course.name,
                                    course_price : parseFloat(this.price).toFixed(2),
                                    course_quantity : 1,
                                    course_total : (this.price * 1).toFixed(2),
                                });                                
                                this.Calculate()
                                this.ClearCourse()
                            }else{
                                toastr.error('Seleccione un Curso ó Rellene el campo del precio')
                            }
                            
                        }else{
                            this.count=0
                        }
                    }
                    else{
                        this.veri=0
                    }
                }else{
                    toastr.warning('Seleccione un Estudiante')
                }    
            },
            studentChange(){
                this.$refs.payment.focus()
                this.CoursesDatails = []
                this.Calculate()
            },
            ClearCourse(){
                this.$refs.course.focus()
                this.course = {}
                this.price = '0.0'
            },
            DeleteCourse(idx) {
                if(confirm('Retirar de la Lista'))
                    this.CoursesDatails.splice(idx, 1)
                    this.Calculate()
            },
            Calculate() {
                this.subtotal = this.return_total
                this.total = this.return_total
            },
            Verification() {
                
            },
            SaveSale() {
                if((Object.keys(this.student).length != 0) && (Object.keys(this.payment).length != 0) && (Object.keys(this.CoursesDatails).length != 0)){
                    axios.post(`${this.Url}save-sale` ,{
                        student_id : this.student.id,
                        payment_id : this.payment.id,
                        currency_id : this.currency.id,
                        description : this.description,
                        credit : this.credit,
                        subtotal: this.subtotal,
                        total: this.total,
                        courses : this.CoursesDatails
                    })
                    .then(response => {
                        this.spinner = true,
                        toastr.success('Se Registro Correctamente la Venta')
                        setTimeout(() => {
                            window.location.href = `${this.Url}sales/${response.data}`;
                        },1000)
                    }).catch(error => {
                        toastr.error(`Ocurrio un Error => ${error}`)
                    })
                }else{
                    toastr.error('Complete los datos para Registrar la Venta')
                }
            }
        },
        computed: {
            return_total(){
                return this.CoursesDatails.reduce((acc, crypt) => {
                    return parseFloat(parseFloat(acc) + parseFloat(crypt.course_total)).toFixed(2)
                }, 0)
            }
        },
        updated() {
            $('.selectpicker').selectpicker('refresh')
        },
    }
</script>
