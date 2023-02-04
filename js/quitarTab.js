document.onkeydown = function(e) {
    if (e.key === 'Tab' || e.keyCode === 9) {
      e.preventDefault();
    }
  };