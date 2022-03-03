<template>
<div class="container">
        <div class="row mt-2">
            <div class="card col-md-6 mx-auto">
                <div class="card-header">
                    <div class="card-title">Fizz Buzz Exercise</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Put a number to check for fizzbuzz</label>
                        <input type="number" v-model.number="number" class="form-control">
                    </div>

                    <table>
                        <tbody>
                            <tr v-for="n in number">
                                <td>{{n}}. {{ fizzNumber(n) }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
</div>
</template>
<script>
export default {
    name:'Fizzbuzz',
    data() {
        return{
            number:null,
            results: [0, "fizz", "buzz", "fizzbuzz"]
        }
    },

    validations:{

    },

    mounted(){
    },

    components:{

    },

    computed:{
    },

    methods:{
        fizzNumber(number){
            var x =0;
            this.results[0] = number;
			if(number % 3 ===0){
				x+=1
			};
			if(number % 5 ===0){
				x+=2
			}
		return this.results[x];
        }
    }
}
</script>
