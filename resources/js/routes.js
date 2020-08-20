import BodyIndex from './components/BodyIndex';
import Funcionarios from './components/Funcionarios';
import Departamentos from './components/Departamentos';

//rotas da aplicação(front)
export default [
    {path: '/', component: BodyIndex},
    {path: '/funcionarios', component: Funcionarios},
    {path: '/departamentos', component: Departamentos}
]