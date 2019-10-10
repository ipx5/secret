class PipesFactory {
    constructor() {
        this.pipes = {}
    }

    registerPipe(pipe) {
        this.pipes[pipe.name] = pipe;
    }

    getPipe(name) {
        console.log(name)
        console.log(this.pipes)
        return this.pipes[name];
    }
}

export const pipesFactory = new PipesFactory();