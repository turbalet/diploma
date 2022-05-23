import {createStore} from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("TOKEN"),
        },
        dashboard: {
            loading: false,
            data: {}
        },
        surveys: {
            loading: false,
            links: [],
            data: []
        },
        universities: {
            loading: false,
            currentPage: 1,
            data: []
        },
        categories: {
            loading: false,
            data: []
        },
        regions: {
            loading: false,
            data: []
        },
        types: {
            loading: false,
            data: []
        },
        languages: {
            loading: false,
            data: []
        },
        questionTypes: ["text", "select", "radio", "checkbox", "textarea"],
        notification: {
            show: false,
            type: 'success',
            message: ''
        }
    },
    getters: {},
    actions: {
        login({commit}, user) {
            return axiosClient.post('/login', user)
                .then(({data}) => {
                    commit('setUser', data.user);
                    commit('setToken', data.token)
                    return data;
                })
        },
        logout({commit}) {
            return axiosClient.post('/logout')
                .then(response => {
                    commit('logout')
                    return response;
                })
        },
        getUser({commit}) {
            return axiosClient.get('/user')
                .then(res => {
                    console.log(res);
                    commit('setUser', res.data)
                })
        },
        getUniversities({commit}, data) {
            commit('setUniversityLoading', true)
            console.log(data)
            return axiosClient.get('/universities', {
                params: {
                    page: data.page,
                    name: data.universityData.name,
                    region: data.universityData.region,
                    category: data.universityData.category,
                    type: data.universityData.type,
                    language: data.universityData.language
                }
            }).then((res) => {
                commit('setUniversityLoading', false)
                commit('setUniversities', res.data);
                return res;
            });
        },
        getCategories({commit},) {
            commit('setCategoryLoading', true)
            return axiosClient.get('/categories').then((res) => {
                commit('setCategoryLoading', false)
                commit('setCategories', res.data);
                return res;
            });
        },
        getRegions({commit}, data) {
            commit('setRegionLoading', true)
            commit('setRegions', []);
            return axiosClient.get('/regions', {
                    params: {
                        page: data.page,
                        name: data.name,
                    },
                }
            ).then((res) => {
                commit('setRegionLoading', false)
                commit('setRegions', res.data);
                return res;
            });
        },
        getTypes({commit},) {
            commit('setTypeLoading', true)
            return axiosClient.get('/types').then((res) => {
                commit('setTypeLoading', false)
                commit('setTypes', res.data);
                return res;
            });
        },
        getLanguages({commit},) {
            commit('setLanguageLoading', true)
            return axiosClient.get('/languages').then((res) => {
                commit('setLanguageLoading', false)
                commit('setLanguages', res.data);
                return res;
            });
        },
        updateUniversity({commit}, data) {
            return axiosClient.put(`/universities/${data.form.id}`,
                {
                    name: data.form.name,
                    description: data.form.description,
                    website: data.form.website,
                    instagram: data.form.instagram,
                    phone_number: data.form.phone_number,
                    region_id: data.form.region.id,
                    category_id: data.form.category.id,
                    type_id: data.form.type.id,
                    language_id: data.form.language.id
                }
            ).then((res) => {
                commit('notify', 'Успех')
                return res;
            });
        },
        uploadUniversityImage({commit}, data) {
            return axiosClient.post(`/universities/image/${data.id}`, data.file, ).then((res) => {
               commit('notify', 'success')
               return res;
            });
        }
    },
    mutations: {
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem("TOKEN");
        },
        setUser: (state, user) => {
            state.user.data = user;
        },
        setToken: (state, token) => {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
        setUniversities: (state, data) => {
            state.universities.data = data;
        },
        setUniversityLoading: (state, loading) => {
            state.universities.loading = loading;
        },
        setCategories: (state, data) => {
            state.categories.data = data;
        },
        setCategoryLoading: (state, loading) => {
            state.categories.loading = loading;
        },
        setRegions: (state, data) => {
            state.regions.data = data;
        },
        setRegionLoading: (state, loading) => {
            state.regions.loading = loading
        },
        setTypes: (state, data) => {
            state.types.data = data
        },
        setTypeLoading: (state, loading) => {
            state.types.loading = loading
        },
        setLanguages: (state, data) => {
            state.languages.data = data
        },
        setLanguageLoading: (state, loading) => {
            state.languages.loading = loading
        },
        notify: (state, message) => {
            state.notification.show = true;
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 3000)
        },
    },
    modules: {},
});

export default store;
