// import '../css/app.css';
// import '../css/base.css';

import './bootstrap';

import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia'
import { VueReCaptcha } from 'vue-recaptcha-v3'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import '../css/style.css';

NProgress.configure({ showSpinner: false, trickleSpeed: 100 })

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia()

// Start/stop NProgress on Inertia events
router.on('start', () => NProgress.start())
router.on('finish', () => NProgress.done())

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(VueReCaptcha, { siteKey: props.initialPage.props.global_shared_data.recaptcha_site_key, loaderOptions: {useRecaptchaNet: false}})
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
