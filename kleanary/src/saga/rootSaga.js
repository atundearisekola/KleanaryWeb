import { fork, all} from 'redux-saga/effects';
import * as appSaga from './appSaga';
import * as laundrySaga from './laundrySaga';


export function* rootSaga(){
    yield all([
        ...Object.values(appSaga)
    ].map(fork))
}