<template>
<div class="container">
    <div class="justify-content-center">
        <div v-for="car in cars" v-bind:key="car.id">
            <div class="form-row col-md-10">
                <div class="form-group col-md-5">
                    <label>Number</label>
                    <input type="text" v-bind:name="`new_car_number[${car.id}]`"  class="form-control" v-bind:value="car.number">
                </div>
                <div class="form-group col-md-5">
                    <label>Driver</label>
                    <input type="text" v-bind:name="`new_car_driver[${car.id}]`" class="form-control" v-bind:value="car.driver">
                </div>
                <div class="form-group col-md mt-4">
                        <button type="button" class="btn btn-danger m-1 form-control" @click="deleteCar(index)">Delete</button>
                </div>
            </div>
        </div>
        <div class="form-row col-md-10">
            <div class="form-group col-md-5">
                <label>Number</label>
                <input type="text" class="form-control" v-model="carNumber">
            </div>
            <div class="form-group col-md-5">
                <label>Driver</label>
                <input type="text" class="form-control" v-model="carDriver">
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
        data(){
            return {
                carNumber:'',
                carDriver:'',
                cars:[],
                carId: 0,
            }
        },
        methods:{
            deleteCar(index){
                this.cars.splice(index, 1)
            },
            addCar(){
                if(this.carNumber && this.carDriver){
                this.cars.push({id: this.carId++, number: this.carNumber, driver: this.carDriver})
                this.carNumber = ''
                this.carDriver = ''
                }
            }
        }
    }
</script>

<style scoped>

</style>
