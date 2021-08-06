import Vue from 'vue';
// window.Vue = require('vue');

/* eslint-disable */
/* [共通] */
Vue.component('header-component', require('./components/common/headerComponent.vue').default);
Vue.component('header-user-component', require('./components/common/headerUserComponent.vue').default);
Vue.component('header-teacher-component', require('./components/common/headerTeacherComponent.vue').default);
Vue.component('sidebar-component', require('./components/common/sidebarComponent.vue').default);
Vue.component('sidebar-search-component', require('./components/common/sidebarSearchComponent.vue').default);

/* [登録周り] */
// カテゴリー一覧を表示して、selectで選択できるコンポーネント
Vue.component('select-list-category-component', require('./components/store/SelectListCategoryComponent.vue').default);
// 画像を5つ表示して、選択できるコンポーネント
Vue.component('select-list-image-component', require('./components/store/SelectListImageComponent.vue').default);

/* [検索] */
Vue.component('search-component', require('./components/search/indexComponent.vue').default);

/* [レッスン] */
// 一覧
Vue.component('lesson-index-component', require('./components/lesson/indexComponent.vue').default);
// 詳細
Vue.component('lesson-show-component', require('./components/lesson/showComponent.vue').default);
// 編集
Vue.component('lesson-edit-component', require('./components/lesson/editComponent.vue').default);
// 詳細 - 画像処理
Vue.component('detail-img-list-component', require('./components/lesson/DetailImgListComponent.vue').default);

/* [講師] */
// 一覧
Vue.component('teacher-index-component', require('./components/teacher/indexComponent.vue').default);
// 詳細
Vue.component('teacher-show-component', require('./components/teacher/showComponent.vue').default);

/* [固定ページ] */
// 受講者よくある質問
Vue.component('page-faq-user-component', require('./components/page/faqUserComponent.vue').default);
// 講師よくある質問
Vue.component('page-faq-teacher-component', require('./components/page/faqTeacherComponent.vue').default);

/* [共通管理画面] */
// メッセージ
Vue.component('user-message-component', require('./components/user/messageComponent.vue').default);
// プロフィール
// Vue.component('user-profile-component', require('./components/user/profileComponent.vue').default);
// プロフィール画像
Vue.component('user-profile-upload-img-component', require('./components/user/ProfileUploadImgComponent.vue').default);
// メッセージの画像の処理
Vue.component('user-profile-message-file-component', require('./components/user/ProfileMessageFileComponent.vue').default);
// 銀行口座
Vue.component('user-bank-component', require('./components/user/bankComponent.vue').default);

/* [受講者管理画面] */
// 受講済みレッスン一覧
Vue.component('user-lesson-component', require('./components/user/lessonComponent.vue').default);
// 出金リクエスト
Vue.component('user-payment-component', require('./components/user/paymentComponent.vue').default);

/* [講師管理画面] */
// コース詳細
Vue.component('teacher-course-detail-component', require('./components/teacher/CourseDetailComponent.vue').default);
// コース登録
Vue.component('course-create-component', require('./components/course/CourseCreate.vue').default);
// レッスン登録
Vue.component('lesson-create-component', require('./components/lesson/LessonCreate.vue').default);
// レッスン追加のモーダル
Vue.component('modal-add-lesson', require('./components/modal/AddLesson.vue').default);
// コースのレッスン追加のモーダル
Vue.component('modal-add-course-lesson', require('./components/modal/AddCourseLesson.vue').default);

/* [管理者画面] */
/* ユーザー */
// 一覧
Vue.component('admin-user-list', require('./components/admin/user/UserList.vue').default);
// 編集
Vue.component('admin-user-edit', require('./components/admin/user/UserEdit.vue').default);
// 詳細
Vue.component('admin-user-show-course-component', require('./components/admin/showCourseComponent.vue').default);
// 新規追加
Vue.component('admin-user-create-component', require('./components/admin/createUserComponent.vue').default);

/* コース */
// 一覧
Vue.component('admin-course-list', require('./components/admin/course/CourseList.vue').default);

/* 取引 */
// 確定前
Vue.component('admin-application-before-list', require('./components/admin/application/ApplicationBeforeList.vue').default);
// 確定後

Vue.component('admin-application-after-list', require('./components/admin/application/ApplicationAfterList.vue').default);

/* 出金リクエスト */
// 一覧
Vue.component('admin-withdrawal-list', require('./components/admin/withdrawal/WithdrawalList.vue').default);
// 一覧
Vue.component('admin-withdrawal-history', require('./components/admin/withdrawal/WithdrawalHistory.vue').default);

/* メッセージ */
Vue.component('admin-message-list', require('./components/admin/message/MessageList.vue').default);


const app = new Vue({
    el: '#app',
});

/* eslint-enable */



// // import { createApp } from 'vue'
// import Vue from 'vue'

// // createApp({ components:{
// new Vue({ components:{
//     // 共通
//     'header-component': require('./components/common/headerComponent.vue').default,
//     'header-user-component': require('./components/common/headerUserComponent.vue').default,
//     'header-teacher-component': require('./components/common/headerTeacherComponent.vue').default,
//     'sidebar-component': require('./components/common/sidebarComponent.vue').default,
//     'sidebar-search-component': require('./components/common/sidebarSearchComponent.vue').default,

//     // [登録周り]
//     // カテゴリー一覧を表示して、selectで選択できるコンポーネント
//     'select-list-category-component': require('./components/store/SelectListCategoryComponent.vue').default,
//     // 画像を5つ表示して、選択できるコンポーネント
//     'select-list-image-component': require('./components/store/SelectListImageComponent.vue').default,

//     // 検索
//     'search-component': require('./components/search/indexComponent.vue').default,

//     // レッスン：一覧
//     'lesson-index-component': require('./components/lesson/indexComponent.vue').default,
//     // レッスン：詳細
//     'lesson-show-component': require('./components/lesson/showComponent.vue').default,
//     // レッスン：編集
//     'lesson-edit-component': require('./components/lesson/editComponent.vue').default,
//     // レッスン：詳細 - 画像処理
//     'detail-img-list-component': require('./components/lesson/DetailImgListComponent.vue').default,

//     // 講師：一覧
//     'teacher-index-component': require('./components/teacher/indexComponent.vue').default,
//     // 講師：詳細
//     'teacher-show-component': require('./components/teacher/showComponent.vue').default,

//     // 固定ページ：受講者よくある質問
//     'page-faq-user-component': require('./components/page/faqUserComponent.vue').default,
//     // 固定ページ：講師よくある質問
//     'page-faq-teacher-component': require('./components/page/faqTeacherComponent.vue').default,

//     // 共通管理画面：メッセージ
//     'user-message-component': require('./components/user/messageComponent.vue').default,
//     // 共通管理画面：プロフィール
//     // 'user-profile-component': require('./components/user/profileComponent.vue').default,
//     // 共通管理画面：プロフィール
//     'user-profile-upload-img-component': require('./components/user/ProfileUploadImgComponent.vue').default,
//     // 共通管理画面：メッセージの画像の処理
//     'user-profile-message-file-component': require('./components/user/ProfileMessageFileComponent.vue').default,
//     // 共通管理画面：銀行口座
//     'user-bank-component': require('./components/user/bankComponent.vue').default,

//     // 受講者管理画面：受講済みレッスン一覧
//     'user-lesson-component': require('./components/user/lessonComponent.vue').default,
//     // 受講者管理画面：出金リクエスト
//     'user-payment-component': require('./components/user/paymentComponent.vue').default,

//     // 講師管理画面：コース詳細
//     'teacher-course-detail-component': require('./components/teacher/CourseDetailComponent.vue').default,
//     // 講師管理画面：コース登録
//     'course-create-component': require('./components/course/CourseCreate.vue').default,
//     // 講師管理画面：レッスン登録
//     'lesson-create-component': require('./components/lesson/LessonCreate.vue').default,
//     // 'teacher-course-relate-lesson-component': require('./components/teacher/CourseRelateLessonComponent.vue').default,

//     // 管理者画面：ユーザー編集
//     'admin-user-edit-component': require('./components/admin/editUserComponent.vue').default,
//     // 管理者画面：ユーザー新規追加
//     'admin-user-create-component': require('./components/admin/createUserComponent.vue').default,
//     // 管理画面：コース詳細
//     'admin-user-show-course-component': require('./components/admin/showCourseComponent.vue').default,

//     // 管理者：出金リクエスト一覧を出力
//     'admin-withdrawal-index-component': require('./components/admin/withdrawal/withdrawalList.vue').default,
// // }}).mount('#app')
// }});
