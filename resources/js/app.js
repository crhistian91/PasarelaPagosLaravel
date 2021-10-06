
require('./bootstrap');

// import {createApp} from 'vue';
import * as _vue from 'vue';




// componentes locales
import HomeComponent  	from './components/HomeComponent.vue'



/*registro de componentes locales*/
const app = _vue.createApp({
	components:{
		HomeComponent,
	}

});

const mountedApp = app.mount('#app');