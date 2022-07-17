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
        programs: {
            loading: false,
            currentPage: 1,
            data: []
        },
        university: {
            data: {}
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
        getPrograms({commit}, data) {
            commit('setProgramLoading', true)

            return axiosClient.get('/programs', {
                params: {
                    page: data.page,
                    name: data.programData.name
                }
            }).then((res) => {
                commit('setProgramLoading', false)
                commit('setPrograms', res.data);
                return res;
            });
        },
        saveProgram({commit, dispatch}, program) {
            let response;
            if (program.id) {
                response = axiosClient.put(`/programs/${program.id}`, program).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            } else {
                response = axiosClient.post(`/programs`, program).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            }
        },
        getUniversity({commit, state}, data) {
            return axiosClient.get(`/universities/${data.id}`).then((res) => {
                state.university.data = res.data
                return res;
            });
        },
        getUniversities({commit}, data) {
            commit('setUniversityLoading', true)
            return axiosClient.get('/universities', {
                params: {
                    page: data.page,
                    name: data.universityData.name,
                    regions: [data.universityData.region],
                    category: data.universityData.category,
                    types: [data.universityData.type],
                    languages: [data.universityData.language]
                }
            }).then((res) => {
                commit('setUniversityLoading', false)
                commit('setUniversities', res.data);
                return res;
            });
        },
        getCategories({commit}, category) {
            commit('setCategoryLoading', true)
            return axiosClient.get('/categories', {
                params: {
                    name: category.name
                }
            }).then((res) => {
                commit('setCategoryLoading', false)
                commit('setCategories', res.data);
                return res;
            });
        },
        saveCategory({commit, dispatch}, category) {
            let response;
            if (category.id) {
                response = axiosClient.put(`/categories/${category.id}`, category).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            } else {
                response = axiosClient.post(`/categories`, category).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            }
        },
        saveType({commit, dispatch}, type) {
            let response;
            if (type.id) {
                response = axiosClient.put(`/types/${type.id}`, type).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            } else {
                response = axiosClient.post(`/types`, type).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            }
        },
        saveLanguage({commit, dispatch}, language) {
            let response;
            if (language.id) {
                response = axiosClient.put(`/languages/${language.id}`, language).then((res) => {
                    return res;
                }).catch(() => {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            } else {
                response = axiosClient.post(`/languages`, language).then((res) => {
                    return res;
                }).catch(()=> {
                    commit('notify', {
                        message: "Произошла ошибка",
                        type: 'error'
                    })
                })
            }
        },
        deleteLanguage({dispatch, commit}, id) {
            return axiosClient.delete(`/languages/${id}`).then((res) => {
                return res;
            }).catch((error) => {
                commit("notify", {
                    type: 'error',
                    message: 'Ошибка'
                })
            });
        },
        deleteType({dispatch, commit}, id) {
            return axiosClient.delete(`/types/${id}`).then((res) => {
                return res;
            }).catch(() => {
                commit("notify", {
                    type: 'error',
                    message: "Произошла ошибка"
                })
            });
        },
        deleteCategory({dispatch, commit}, id) {
            return axiosClient.delete(`/categories/${id}`).then((res) => {
                return res;
            }).catch(() => {
                commit("notify", {
                    type: 'error',
                    message: "Произошла ошибка"
                })
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
        },
        saveUniversity({commit, dispatch}, university) {
            delete university.image_url;
            delete university.logo_url;
            university.region_id = university.region.id;
            university.language_id = university.language.id;
            university.category_id =  university.category.id;
            university.type_id = university.type.id;
            delete university.region;
            delete university.language;
            delete university.category;
            delete university.type;
            let response;
            if (university.id) {
                response = axiosClient
                    .put(`/universities/${university.id}`, university)
                    .then((res)=> {
                        return res;
                    }).catch(()=> {
                        commit('notify', {
                            message: "Произошла ошибка",
                            type: 'error'
                        })
                    })
            } else {
                response = axiosClient
                    .post("/universities", university).then((res) => {
                        return res;
                    }).catch(() => {
                        commit('notify', {
                            message: "Произошла ошибка",
                            type: 'error'
                        })
                    })
            }
            return response;
        },
        deleteUniversity({dispatch, commit}, id) {
            return axiosClient.delete(`/universities/${id}`).then((res) => {
               return res;
            }).catch(() => {
                commit("notify", {
                    type: 'error',
                    message: "Произошла ошибка"
                })
            });
        },
        saveRegion({commit, dispatch}, region) {
            let response;
            if (region.id) {
                response = axiosClient
                    .put(`/regions/${region.id}`, region)
                    .then((res)=> {
                        return res;
                    }).catch(() => {
                        commit('notify', {
                            message: "Произошла ошибка",
                            type: 'error'
                        })
                    })
            } else {
                response = axiosClient
                    .post("/regions", region).then((res) => {
                        return res;
                    }).catch(() => {
                        commit('notify', {
                            message: "Произошла ошибка",
                            type: 'error'
                        })
                    })
            }
            return response;
        },
        deleteRegion({dispatch, commit}, id) {
            return axiosClient.delete(`/regions/${id}`).then((res) => {
                commit('notify', {
                    message: "Успешно удалено",
                    type: 'success'
                })
                return res;
            });
        },
        deleteProgram({dispatch, commit}, id) {
            return axiosClient.delete(`/programs/${id}`).then((res) => {
                commit('notify', {
                    message: "Успешно удалено",
                    type: 'success'
                })
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
        setPrograms: (state, data) => {
            state.programs.data = data
        },
        setProgramLoading: (state, loading) => {
            state.programs.loading = loading
        },
        notify: (state, {message, type}) => {
            state.notification.show = true;
            state.notification.type = type
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 3000)
        },
    },
    modules: {},
});

export default store;
