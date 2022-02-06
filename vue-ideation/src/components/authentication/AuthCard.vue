<template lang="">
    <div style="">
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
            },

            processing: false,

        }
    },  
    components: {
    },
    destroyed() {
        this.$store.commit('closeToast')
    },
    methods: {
        async signUp() {
            try {
                    // this.processing = true
                    await api.createSession()
                    let res = await api.register(this.formSignUp)
                    if(res.data.success) {
                        this.formSignUp.name = ''
                        this.formSignUp.username = ''
                        this.formSignUp.email = ''
                        this.formSignUp.password = ''
                        this.formSignUp.password_confirmation = ''

                        this.isSignUp = false
                    } else {
                        if(typeof res.data.errors == 'object' && res.data.errors != null) {
                            let email = res.data.errors.email ? res.data.errors.email : ''
                            let username = res.data.errors.username ? res.data.errors.username : ''
                            let pass = res.data.errors.password? res.data.errors.password : ''
                            let message =  email + '\n' + username + '\n' + pass 

                            
                            this.$store.commit('setTypeToast', 'Error')
                            this.$store.commit('setMessage', message)
                            this.$store.commit('showToast')
                        } else {
                            this.$store.commit('setTypeToast', 'Error')
                            this.$store.commit('setMessage', res.data.errors)
                            this.$store.commit('showToast')
                            
                        }

                    }

            } catch (error) {
                console.log(error)
            }
        },

        async signIn() {
            try {
                if(!this.processing) {
                    this.processing = true
                    let res = await this.$store.dispatch('login', this.formSignIn)
                    if(res.data.success) {
                        this.$router.push({name: 'ProjectsList'})
                        this.formSignIn.email = ''
                        this.formSignIn.password = ''
                        this.processing = false
                    } else {
                        if(typeof res.data.errors == 'object' && res.data.errors != null) {
                            let email = res.data.errors.email ? res.data.errors.email : ''
                            let username = res.data.errors.username ? res.data.errors.username : ''
                            let pass = res.data.errors.password? res.data.errors.password : ''
                            let message =  email + '\n' + username + '\n' + pass 
                            // alert(message)                            
                            this.$store.commit('setTypeToast', 'Error')
                            this.$store.commit('setMessage', message)
                            this.$store.commit('showToast')
                        } else {
                            this.$store.commit('setTypeToast', 'Error')
                            this.$store.commit('setMessage', res.data.errors)
                            this.$store.commit('showToast')
                            
                        }

                    }
                        this.processing = false
                    //     this.$store.commit('setTypeToast', 'Error')
                    //     this.$store.commit('setMessage', res.data.errors)
                    //     this.$store.commit('showToast')


                }
            } catch (error) {
                console.log(error)

            }
        }
    }
}
</script>

<style scoped>
.auth-container {
    background-color: #fff;
	border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 500px;
    margin-bottom: 10px;
    z-index: 0;
}

.auth-h1 {
	font-weight: bold;
	margin: 0;
}

.auth-h2 {
	text-align: center;
}

.auth-p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

.auth-span {
	font-size: 12px;
    margin-bottom: 4em;
}

.auth-a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

.auth-btn {
	border-radius: 20px;
	border: 1px solid #4136F1;
	background-color: #4136F1;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
	cursor: pointer;
}

.auth-btn:active {
	transform: scale(0.95);
}

.auth-btn:focus {
	outline: none;
}

.auth-btn.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

.auth-form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

.auth-input {
	background-color: #fff;
    border-color: #333;
    border-width: 1px;	
    border-radius: 9999px;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}

.auth-container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.auth-container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}
	
	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}

.auth-container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #8743FF;
	background: -webkit-linear-gradient(to right, #4136F1, #8743FF);
	background: linear-gradient(to right, #4136F1, #8743FF);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
    transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.auth-container.right-panel-active .overlay {
    transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(0%);
}

.auth-containerright-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.auth-containerright-panel-active .overlay-right {
	transform: translateX(20%);
}
</style>
