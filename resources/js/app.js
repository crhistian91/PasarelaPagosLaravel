
require('./bootstrap');

// import {createApp} from 'vue';
import * as _vue from 'vue';




// componentes locales
import ExampleComponent  	from './components/ExampleComponent.vue'



/*registro de componentes locales*/
const app = _vue.createApp({
	components:{
		ExampleComponent,
	}

});

const mountedApp = app.mount('#app');