box.cfg {listen=3302}

queue = require('queue')
queue.start()

queue.create_tube('foobar', 'fifottl', {if_not_exists=true})
