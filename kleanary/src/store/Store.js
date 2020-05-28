import {createStore,applyMiddleware,compose} from 'redux';
import createSagaMiddleware from "redux-saga";

import RootReducer from '../reducers/RootReducer';
import { loadState, saveState } from "../Utils/localstorage";
import {rootSaga} from '../saga/rootSaga';




const sagaMiddleware = createSagaMiddleware();
var middleware = applyMiddleware(sagaMiddleware);
var composeEnhancers = (typeof window !== 'undefined' && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__) || compose;





export const giveMeStore = () => {
 const persistedState = loadState();
const store = createStore(RootReducer,persistedState,composeEnhancers(middleware));
sagaMiddleware.run(rootSaga);

  //user contains the TOKEN
  store.subscribe(() => {
    saveState({
      AuthReducer: store.getState().AuthReducer
    });
  });
  return store;
}
export default giveMeStore;