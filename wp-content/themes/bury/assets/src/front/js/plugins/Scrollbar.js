import SimpleBar from 'simplebar';

export default class Scrollbar
{
    init() {
        document.querySelectorAll('[data-simplebar]').forEach(el => {
            new SimpleBar(
                el,
                {
                    autoHide: false,
                }
            );
        });
    }
}
