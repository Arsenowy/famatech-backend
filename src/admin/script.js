var note = document.querySelectorAll('.note__element');
i = 320;

note.forEach(el => {
    el.setAttribute('style', `border-color: hsl(${i}, 100%, 50%);`);
    i-=30;
    if (i < 20) i = 320;
});

