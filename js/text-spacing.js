const textpathAnimation = new function () {
    const buttonEl = document.getElementById('accessible-text-svg-demo__control');
    const rolloutEl = document.getElementById('rollout');
    const rollinEl = document.getElementById('rollin');
    let state = 'rollout';

    const clickEvent = (e) => {
        const animEl = document.getElementById(state);
        state = (state == 'rollout') ? 'rollin' : 'rollout';
        animEl.beginElement();
    }

	const init = () => {
        buttonEl.addEventListener('click', clickEvent);
    }

    init();
}
