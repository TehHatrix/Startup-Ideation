<template lang="">
    <div>
        <div class="auth-container " :class="[isSignUp ? rightPanelOverlay : '']" id="container">
            <div class="form-container sign-up-container"  >
                <form @submit.prevent="signUp" class="auth-form" >
                    <h1 class="auth-h1">Create Account</h1>
                    <span class="auth-span">or use your email for registration</span>
                    <input class="auth-input" type="text" placeholder="Name" v-model="formSignUp.name" />
                    <input class="auth-input" type="text" placeholder="Username" v-model="formSignUp.username" />
                    <input class="auth-input" type="email" placeholder="Email" v-model="formSignUp.email" />
                    <input class="auth-input" type="password" placeholder="Password" v-model="formSignUp.password"/>
                    <input class="auth-input" type="password" placeholder="Password Confirmation" v-model="formSignUp.password_confirmation" />
                    <button class="auth-btn" >Sign Up</button>
                </form>
            </div>
            <div @submit.prevent="signIn" class="form-container sign-in-container">
                <form class="auth-form" >
                    <h1 class="auth-h1" >Sign in</h1>
                    <span class="auth-span">or use your account</span>
                    <input class="auth-input" type="email" placeholder="Email" v-model="formSignIn.email" />
                    <input class="auth-input" type="password" placeholder="Password" v-model="formSignIn.password" />
                    <a class="auth-a" href="#">Forgot your password?</a>
                    <button class="auth-btn" >Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1 class="auth-h1">Welcome Back!</h1>
                        <p class="auth-p">To keep connected with us please login with your personal info</p>
                        <button class="ghost auth-btn" id="signIn" @click="isSignUp = !isSignUp" >Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1 class="auth-h1">Hello, Friend!</h1>
                        <p class="auth-p">Enter your personal details and start journey with us</p>
                        <button class="ghost auth-btn" id="signUp" @click="isSignUp = !isSignUp" >Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import api from '@/api/authApi'

export default {
    name: 'AuthCard',
    data() {
        return {
            isSignUp: false, 
            rightPanelOverlay: 'right-panel-active',
            formSignIn: { 
                email: '',
                password: ''
            },
            formSignUp: {
                username: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: ''

            }
        }
    },  
    methods: {
        async signUp() {
            try {
                await api.createSession()
                let res = await api.register(this.formSignUp)
                if(!res.data.success) {
                    console.log(res.data.errors)
                }

                if(res.data.success) {
                    this.formSignUp.username = ''
                    this.formSignUp.name = ''
                    this.formSignUp.email = ''
                    this.formSignUp.password = ''
                    this.formSignUp.password_confirmation = ''

                    this.isSignUp = false
                }
            } catch (error) {
                console.log(error)
            }
        },

        async signIn() {
            try {
                let data = await this.$store.dispatch('login', this.formSignIn)

                if(!data.success) {console.log(data.message)}
                if(data.success) this.$router.push({name: 'ProjectsList'})
                this.formSignIn.email = ''
                this.formSignIn.password = ''
            } catch (error) {
                console.log(error)

            }
        }

    }
}
</script>
