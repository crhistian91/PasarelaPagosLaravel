<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pasarela de Pagos APP</div>
                    <div class="card-body">
                       <div class="row">
                           <div class="col-auto">
                               <label for="">Cuanto es el valor que desea cancelar? </label>
                               <input type="number" class="form-control" min="5" style="0.01" required v-model="form.value">
                               <small class="form-text text-muted"> Por digite el Valor en pesos que desea cancelar</small>
                           </div>
                           <div class="col-auto">
                               <label for="">Moneda</label>
                               <select class="custom-select" v-model="form.currency">
                                   <option v-for="(item, index) in arrayData.getCurrecies" :key="index" :value="item.iso">{{ item.iso.toUpperCase() }}</option>
                               </select>
                           </div>
                       </div> 
                       <div class="row mt-3">
                            <div class="col-auto">
                               <label for="">Seleccione un metodo de pago</label>
                               <div class="form-group">
                                   <div class="btn-group btn-group-toggle" data-toggle="buttons" >
                                       <label class="btn btn-outline-secondary rounded m-2 p-1" v-for="paymentplatform in arrayData.getPaymentPlatform">
                                           <input type="radio" :value="paymentplatform.id" @click="seleccionarPlatform(paymentplatform.name)" required v-model="form.payment_platform">
                                           <img :src="'../../'+paymentplatform.image" class="img-thumbnail">
                                       </label>
                                   </div>
                               </div>
                               <div v-if="flag.methodsPayPaypal">
                                    <small>Seras dirigido al checkout de paypal.</small>
                                </div>
                                <div v-if="flag.methodsPayStripe">
                                    <small>Seras dirigido al checkout de Stripe.</small>
                                </div>
                                <div v-if="flag.methodsPlacetopay">
                                    <small>Seras dirigido al checkout de Placetopay.</small>
                                </div>
                            </div>
                       </div>
                       <div class="text-center mt-3">
                           <button type="button" class="btn btn-primary btn-lg" @click="storePay()">Pagar</button>
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
                arrayData: {
                    getCurrecies: [],
                    getPaymentPlatform: [],
                },
                variables:{
                    methodPay:'',
                },
                flag: {
                    methodsPayPaypal: false,
                    methodsPayStripe: false,
                    methodsPlacetopay: false,
                },
                form:{
                    value: '',
                    currency: '',
                    payment_platform: '',
                },
            }
        },
        computed:{},
        methods: {

            getCurrencies: async function(){
                const url = 'getcurrencies';

                try {
                    const response                      = await axios.get(url)
                    const respuesta                     = response.data;
                    this.arrayData.getCurrecies         = respuesta.currencies;
                    this.arrayData.getPaymentPlatform   = respuesta.PaymentPlatform; 
                                      
                  } catch (error) {

                    if (error.response.status === 500) {
                        console.log(error.reponse)
                    }
                    if (error.response.status === 404) {
                        console.log(error.reponse)
                    }
                } 
            },

            seleccionarPlatform: function(data){

                this.limpiar();
                this.variables.methodPay = data;

                if (this.variables.methodPay == 'Paypal') {
                    this.flag.methodsPayPaypal = true;
                    this.flag.methodsPayStripe = false;
                    this.flag.methodsPlacetopay = false;
                }

                if (this.variables.methodPay == 'Stripe') {
                    this.flag.methodsPayPaypal = false;
                    this.flag.methodsPayStripe = true;
                    this.flag.methodsPlacetopay = false;
                }
                if (this.variables.methodPay == 'Placetopay') {
                    this.flag.methodsPayPaypal = false;
                    this.flag.methodsPayStripe = false;
                    this.flag.methodsPlacetopay = true;
                }
            },

            limpiar: function(){
                this.flag.methodsPayPaypal = false;
                this.flag.methodsPayStripe = false;
                this.flag.methodsPlacetopay = false;
            },

            storePay: async function(){
                
                const request = {
                    'value'             : this.form.value,
                    'currency'          : this.form.currency,
                    'payment_platform'  : this.form.payment_platform,
                }

               try {
                    const response = await axios.post('payments/pay', request)

                    if (response.status === 200) {
                     
                    }
                } catch (error) {
                    if (error.response.status === 404) {
                      console.log(error);
                    }
                    if (error.response.status === 500) {
                      console.log(error.reponse)
                    }
                }

              },
            
            
        },

        mounted() {
            this.getCurrencies();
            console.log('Component mounted.')
        },

    }
</script>
