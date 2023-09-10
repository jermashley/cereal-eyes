import { faGithub } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Transition } from '@headlessui/react'
import { usePage } from '@inertiajs/react'
import { Fragment } from 'react'

import { buttonVariants } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'

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
        enter="transform transition duration-700"
        enterFrom="opacity-0 scale-90"
        enterTo="opacity-100 scale-100"
        leave="transform duration-200 transition ease-in-out"
        leaveFrom="opacity-100 scale-100"
        leaveTo="opacity-80 scale-90"
      >
        <Card>
          <CardHeader>
            <CardTitle>{appName}</CardTitle>

            <CardDescription>
              Your portal for onboarding a new team member.
            </CardDescription>
          </CardHeader>

          <CardContent>
            <p>
              <a
                className={buttonVariants({
                  variant: `outline`,
                  className: `w-full`,
                })}
                href="/auth/redirect/github"
              >
                <FontAwesomeIcon
                  icon={faGithub}
                  className="text-lg"
                  fixedWidth
                />

                <span>Sign in with Github</span>
              </a>
            </p>
          </CardContent>
        </Card>
      </Transition>
    </section>
  )
}

export default LoginPage
