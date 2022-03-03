<template>
<div class="container">
        <div class="row mt-2">
            <div class="card col-md-6 mx-auto">
                <div class="card-header">
                    <div class="card-title">Palindrome Exercise</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Put anything to check if its palindrome</label>
                        <input type="text" v-model="palindrome" class="form-control">
                        <p :style="{ color: isPalindrome ? 'green' : 'red '}" class="text-center mt-2">{{ isPalindrome ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>
<script>
export default {
    name:'Palindrome',
    data() {
        return{
            palindrome:'',
        }
    },

    validations:{

    },

    mounted(){
    },

    components:{

    },

    computed:{
        isPalindrome(){
            console.log( this.checkIfPalindrome(this.palindrome));
            console.log(this.palindrome)
            return this.palindrome && this.checkIfPalindrome(this.palindrome)
        }

    },

    methods:{
        checkIfPalindrome(value){
            var reverseValue = value.split('').reverse().join('')
            if(reverseValue === value){
                return true;
            }
            return false;
        }
    }
}
</script>
