import { faGithub } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Transition } from '@headlessui/react'
import { usePage } from '@inertiajs/react'
import { Fragment } from 'react'

const LoginPage = () => {
  const {
    app: { name: appName },
  } = usePage().props

  return (
    <section className="flex h-full w-full flex-grow flex-col items-center justify-center space-y-2">
      <Transition
        appear
        show
        as={Fragment}
        enter="transform transition duration-[600ms]"
        enterFrom="opacity-0 scale-90"
        enterTo="opacity-100 scale-100"
        leave="transform duration-200 transition ease-in-out"
        leaveFrom="opacity-100 scale-100 "
        leaveTo="opacity-80 scale-90"
      >
        <div className="flex w-full max-w-sm flex-col rounded-sm border border-zinc-200 bg-zinc-50/80 px-8 py-10 shadow-xl dark:border-zinc-700 dark:bg-zinc-800/80">
          <h1 className="text-center text-3xl font-medium opacity-80">
            {appName}
          </h1>

          <p className="mt-4 text-center text-sm opacity-80">
            Your portal for onboarding a new team member.
          </p>

          <a
            className="mt-12 flex flex-row items-center justify-center space-x-2 rounded-sm border border-zinc-200/75 bg-zinc-100 px-4 py-2 text-sm text-zinc-700 transition-all duration-200 dark:border-zinc-600/75 dark:bg-zinc-700 dark:text-zinc-200 hover:dark:bg-zinc-600"
            href="/auth/redirect/github"
          >
            <FontAwesomeIcon icon={faGithub} className="text-lg" fixedWidth />

            <span>Sign in with Github</span>
          </a>
        </div>
      </Transition>
    </section>
  )
}

export default LoginPage
