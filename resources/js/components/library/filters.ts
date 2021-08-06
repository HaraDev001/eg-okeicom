import moment from "moment"
import 'moment/locale/ja'
// moment.js
export function datetotime (t) {
    return t ? moment(t).format('lll') : ''
}
