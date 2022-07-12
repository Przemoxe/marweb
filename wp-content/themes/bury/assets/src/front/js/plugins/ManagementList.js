
export default class managementList
{
    constructor() {
        this.setManagementContentHeight = this.setManagementContentHeight.bind(this);
    }
    init() {
        const managementList = document.querySelectorAll('.ae-container.management-list');
        managementList.forEach(el => {
            this.setManagementContentHeight(el);
        });       
    }

    setManagementContentHeight(managementListContainer){      
        let managementContent = managementListContainer.querySelector('.tab-pane');
        managementListContainer.style.minHeight = managementContent.offsetHeight + "px";
        const Container = managementListContainer.querySelectorAll('.nav-link');
        const PhotoContainer = managementListContainer.querySelectorAll('.tab-pane.fade.show');
        for (let i = 0; i < Container.length; i++) {
            Container[i].classList.add('act'+i);
            PhotoContainer[i].classList.add('act'+i);
        }
        for (let i = 0; i < Container.length; i++) {
            let name = ".act"+i;
            managementListContainer.querySelector(name).addEventListener('click', function () {
                managementContent = managementListContainer.querySelector('.tab-pane.fade'+name);
                managementListContainer.style.minHeight = managementContent.offsetHeight + "px";
            });
        }
    }
}