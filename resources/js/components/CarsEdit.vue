<template>
    <div class="container">
        <div class="justify-content-center">
            <div v-for="(car, index) in cars" v-bind:key="car.id">
                <div class="form-row col-md-10">
                    <div class="form-group col-md-5">
                        <label>Number</label>
                        <input type="text" v-bind:name="`${car.status}_car_number[${car.id}]`"  class="form-control" v-model="car.number">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Driver</label>
                        <input type="text" v-bind:name="`${car.status}_car_driver[${car.id}]`" class="form-control" v-model="car.driver">
                    </div>
                    <div class="form-group col-md mt-4">
                        <button type="button" class="btn btn-danger m-1 form-control" @click="deleteCar(car, index)">Delete</button>
                    </div>
                </div>
            </div>
            <div class="form-row col-md-10">
                <div class="form-group col-md-5">
                    <label>Number</label>
                    <input type="text" class="form-control" value="" v-model="carNumber">
                </div>
                <div class="form-group col-md-5">
                    <label>Driver</label>
                    <input type="text" class="form-control" value="" v-model="carDriver">
                </div>
            </div>
            <div class="d-flex flex-row bd-highlight mb-4">
                <div class="p-2 bd-highlight"><button type="button" class="btn btn-primary m-1 form-control" @click="addCar">Add</button></div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['carparkcars'],
        data(){
            return {
                carNumber:'',
                carDriver:'',
                cars:[],
                carId: 0,
            }
        },
        methods:{
            setCars(){
                this.cars = this.carparkcars
                this.setStatus(this.cars)
            },
            setStatus(cars){
                cars.forEach(element => element.status = 'exist')
            },
            deleteCar(car, index){
                    if(car.status === 'exist'){
                    fetch(`http://mysite.local:8000/car/${car.id}`,{
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                    )
                    .then(() => {
                        this.cars.splice(index, 1)
                    })
                    }else{
                        this.cars.splice(index, 1)
                    }
            },
            addCar(){
                if(this.carNumber && this.carDriver){
                    this.cars.push({id: this.carId++, number: this.carNumber, driver: this.carDriver, status: 'new'})
                    this.carNumber = ''
                    this.carDriver = ''
                }
            }
        },
        mounted() {
            this.setCars()
            console.log('testa')
        }
    }
</script>

<style scoped>

</style>
